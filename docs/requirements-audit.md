# BarberHub — Instructor PDF Requirements Audit

This checklist compares the current Laravel source against the assignment PDF,
“GROUP ACTIVITY: Building a Multi-Page Laravel Web App”.

## Implemented in the source code

- [/] Home page with a hero section and a short description of the barbershop theme.
- [/] Member 1 JavaScript requirement: persistent dark/light mode toggle (`public/js/theme.js`).
- [/] About page with business background, mission, vision, and values.
- [/] About page team/staff-style cards for the three listed project members.
- [/] Member 2 JavaScript requirement: Read More / Read Less toggle (`public/js/about.js`).
- [/] Contact page with name, email, subject, and message fields.
- [/] Contact details shown on the Contact page.
- [/] Member 3 JavaScript requirement: client-side required-field and email validation with inline errors (`public/js/contact-validation.js`).
- [/] Valid contact submissions are checked again by Laravel and receive a success flash message.
- [/] Shared Blade layout at `resources/views/layouts/app.blade.php`.
- [/] Shared navigation and footer containing the three member names currently present in the project.
- [/] Home, About, and Contact views extend `layouts.app` and define their content section.
- [/] Each required public page has its own CSS and JavaScript file.
- [/] Page assets are loaded using `asset()` inside `@push('styles')` / `@push('scripts')`; the shared layout renders `@stack('styles')` / `@stack('scripts')`.
- [/] Home, About, and Contact routes are defined in `routes/web.php`.
- [/] Main navigation links connect the public pages.

## Still requires your group's real submission details or GitHub actions

- [/] Confirm and enter the group's official section in `README.md`. The supplied project archive did not identify the official section, so it has intentionally not been guessed.
- [/] Add real screenshots of the running Home, About, and Contact pages to `docs/screenshots/` (`home.png`, `about.png`, `contact.png`).
- [/] Verify the actual GitHub repository name follows the instructor's required naming pattern.
- [/] Each member must create/use their own branch and make at least five meaningful commits.
- [/] Open Pull Requests from each member branch and have the group leader review/merge them.
- [/] Submit the repository link and invitation link as required by the instructor.

## Important limitation

A ZIP archive does not contain verifiable GitHub branch history, commit counts, Pull Requests,
repository collaborators, or invitation links. Those items must be completed and checked in
the group's actual GitHub repository. Do not claim these are complete based only on this ZIP.
