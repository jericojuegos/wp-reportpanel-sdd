# WP ReportPanel SDD

> **Spec-Driven Development (SDD) Practice Build**  
> A modular reporting dashboard inspired by LearnDash ProPanel—rebuilt through a structured, spec-first development workflow.

---

## 🎯 Purpose

This plugin was built as a technical exploration of **Spec Driven Development**, where **every module begins with a written spec** before any code is written.

**Core Goals**

- 🧠 Practice SDD methodology in a real WordPress plugin environment
- 🧩 Design a modular reporting architecture inspired by LMS dashboards
- 📚 Produce reusable specs and scaffolding patterns for future builds

---

## 📦 Tech Stack & Architecture

| Layer           | Tech Used                                | Purpose                     |
| --------------- | ---------------------------------------- | --------------------------- |
| 🧠 Architecture | Spec-Driven Development (Markdown Specs) | Planning & traceability     |
| ⚙️ Backend      | WordPress (PHP), LearnDash Hooks         | Data logic & integration    |
| 🎨 Frontend     | React (modular components)               | UI for dashboard panels     |
| 📂 Specs Folder | `/specs/*.md`                            | Source of truth for modules |

---

## 📄 Spec-Driven Workflow

Each module follows a repeatable pipeline:

1. **📝 Feature Spec** — Written in `/specs/` (Markdown format)
2. **🧩 Implementation** — PHP + React strictly based on the spec
3. **✅ Validation** — Checks against spec (manual/automated)
4. **📚 Documentation** — Generated from spec + code references

---

## 🚀 Current Features

- 📊 Admin dashboard — tracks user activity and course progress
- 🔍 Dynamic filters — by role, completion status, and engagement
- 📁 Export reports — CSV & JSON format
- 🎯 LearnDash-compatible hooks — extensible event triggers
- 🔗 Spec-linked modules — improves traceability and onboarding

> _Coming soon:_ More panels, REST API endpoints, and CLI-driven spec generation.

---
