import { test, expect } from '@wordpress/e2e-test-utils-playwright'

const { describe } = test

/**
 * Tests to exercise the frontend and admin features
 *
 * Note: To interact with pages, locate elements by user-visible locators like
 * accessible role, instead of CSS selectors which can change.
 *
 * @see https://developer.wordpress.org/block-editor/contributors/code/testing-overview/e2e/
 * @see https://playwright.dev/docs/locators
 * @see https://www.w3.org/TR/html-aria/#docconformance
 */

describe('Admin', () => {
  test('Dashboard', async ({ admin, page }) => {
    await admin.visitAdminPage('/')
    const heading = page.getByRole('heading', {
      name: 'Welcome to WordPress',
      level: 2,
    })
    await expect(heading).toBeVisible()
  })

  const plugins = [
    ['Report Panel', 'wp-reportpanel-sdd/wp-reportpanel-sdd'],
  ]

  for (const [pluginTitle, pluginBasename] of plugins) {
    test(`${pluginTitle} installed`, async ({ admin, page, requestUtils }) => {
      await admin.visitAdminPage('/')

      // const plugins = await requestUtils.rest({
      //   path: 'wp/v2/plugins',
      // })
      // expect(plugins).toContain(pluginBasename)
      // console.log('plugins', plugins)

      const result = await requestUtils.rest({
        path: `wp/v2/plugins/${pluginBasename}`,
      })
      // console.log('plugin', result)

      expect(result.plugin).toBe(pluginBasename)
    })

    test(`Activate ${pluginTitle}`, async ({ admin, page, request, requestUtils }) => {
      await admin.visitAdminPage('plugins.php')

      // See if plugin is active or not
      const pluginClasses = await page.evaluate(({ pluginBasename }) => {
        const $row = document.querySelector(
          `[data-plugin="${pluginBasename}.php"]`
        )
        return [...$row.classList]
      }, { pluginBasename })

      if (!pluginClasses.includes('active')) {
        await expect(pluginClasses).toContain('inactive')

        // Find the Activate link

        const activateLink = await page.evaluate(({ pluginBasename }) => {
          const $row = document.querySelector(
            `[data-plugin="${pluginBasename}.php"]`
          )
          const $activate = $row.querySelector('a.edit')
          return $activate?.href
        }, { pluginBasename })

        await expect(activateLink).toBeTruthy()

        // Make a POST request
        await request.post(activateLink)
      }

      const plugin = await requestUtils.rest({
        path: `wp/v2/plugins/${pluginBasename}`,
      })

      expect(plugin.status).toBe('active')
    })
  }
})

describe('Admin menu', () => {
  test('Exists', async ({ admin, page }) => {
    await admin.visitAdminPage('/')
    expect(page.getByRole('navigation', { name: 'Main menu' })).toHaveCount(1)
  })
})

describe('Plugin settings page', () => {
  test('Can be visited', async ({ admin, page }) => {
    await admin.visitAdminPage('/options-general.php?page=wp-reportpanel-sdd-settings')
    const heading = await page.getByRole('heading', {
      name: 'Report Panel',
    })
    await expect(heading).toBeVisible()
  })
})
