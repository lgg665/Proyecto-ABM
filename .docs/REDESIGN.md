# Project UI Redesign — Tech Dark Terminal Theme

## Objective

Redesign the existing PHP ABM Users project to give it a modern, technological, dark "system/terminal" aesthetic.

The redesign must focus on the **Frontend/UI only** unless a backend change is strictly necessary.

The existing functionality, database structure, PHP logic, routes, controllers, models, and CRUD behavior must continue working exactly as they do now.

Do not rewrite the application architecture.

---

## Current Project Structure

The project currently follows this structure:

```text
Proyecto-ABM/
├── .docs/
├── backend/
│   ├── config/
│   ├── controllers/
│   ├── models/
│   ├── repositories/
│   └── services/
├── database/
│   └── abm_usuarios.sql
├── frontend/
│   ├── css/
│   ├── views/
│   │   └── users/
│   └── index.php
└── README.md
```

The application is a PHP CRUD/ABM for Users and Roles.

The main functionality includes:

* User listing
* Create user
* Edit user
* Delete user
* User roles
* Database persistence
* Success and error messages

---

# Design Direction

The new interface should look like a **modern administration dashboard for a technical system**, inspired by:

* Terminal interfaces
* Developer tools
* Cyber/tech dashboards
* Modern SaaS admin panels
* System monitoring interfaces

Avoid excessive "cyberpunk" styling.

The design should feel:

* Professional
* Clean
* Modern
* Technical
* Dark
* High contrast
* Easy to read
* Suitable for an academic software project

Do not make the interface look like a video game.

---

# Color System

Use the following colors as the foundation.

## Main background

```css
--bg-primary: #080c14;
```

This should be the dominant background color.

Use very dark blue-black tones for the page background and major sections.

## Secondary surfaces

Use subtle variations around the main background:

```css
--bg-secondary: #0d1420;
--bg-surface: #111927;
--bg-surface-hover: #151f2f;
```

Surfaces should have enough contrast to distinguish cards, forms and tables without becoming bright.

## Primary accent

```css
--accent-cyan: #00d4ff;
```

Use neon cyan for:

* Buttons
* Links
* Active states
* Table headers
* Important labels
* Focus indicators
* Interactive elements
* Small decorative elements

Use glow effects carefully.

Example:

```css
box-shadow:
    0 0 8px rgba(0, 212, 255, 0.35),
    0 0 20px rgba(0, 212, 255, 0.12);
```

Do not apply strong glow to every element.

---

# Additional Colors

Use a restrained semantic color system.

## Success

Use a green/cyan-green tone for successful operations.

```css
--success: #35e69a;
```

## Error

Use a red tone for errors.

```css
--error: #ff4d67;
```

## Warning

Use an amber/orange tone when necessary.

```css
--warning: #ffb84d;
```

## Primary text

```css
--text-primary: #e8f1f7;
```

## Secondary text

```css
--text-secondary: #8c9aaa;
```

## Borders

Use subtle blue-gray borders.

```css
--border: rgba(130, 170, 200, 0.15);
```

---

# Background Grid / Terminal Overlay

Create a subtle technical grid overlay over the main background.

The grid should resemble a terminal or engineering interface.

Use CSS pseudo-elements where appropriate.

Example concept:

```css
body::before {
    content: "";
    position: fixed;
    inset: 0;
    pointer-events: none;

    background-image:
        linear-gradient(
            rgba(0, 212, 255, 0.035) 1px,
            transparent 1px
        ),
        linear-gradient(
            90deg,
            rgba(0, 212, 255, 0.035) 1px,
            transparent 1px
        );

    background-size: 40px 40px;
}
```

The grid must remain subtle.

It should never interfere with text readability.

Do not use an image for the grid unless absolutely necessary.

---

# Typography

Use:

## Main font

**Outfit**

Use Outfit for:

* Page titles
* Headings
* Navigation
* Buttons
* Form labels
* General text

## Technical font

**JetBrains Mono**

Use JetBrains Mono for:

* User IDs
* Database IDs
* Role identifiers
* Technical labels
* Status values
* Small metadata
* Table identifiers
* Code-like information

Example:

```text
USR-001
ADMIN
ACTIVE
ROLE-02
```

The visual distinction between normal text and technical data should make the interface feel like a system dashboard.

---

# Typography Hierarchy

Create a clear hierarchy.

Page title:

```text
font-family: Outfit;
font-weight: 700;
```

Technical metadata:

```text
font-family: "JetBrains Mono";
font-size: 0.8rem;
letter-spacing: 0.04em;
```

Do not overuse uppercase text.

Use uppercase mainly for technical labels and status indicators.

---

# Main Layout

The application should have a modern dashboard-style layout.

Suggested structure:

```text
┌──────────────────────────────────────────────┐
│ SYSTEM / USER MANAGEMENT                    │
│----------------------------------------------│
│                                              │
│ Users                         [+ New User]   │
│ Manage registered users                      │
│                                              │
│ ┌──────────────────────────────────────────┐ │
│ │ ID │ USER │ EMAIL │ ROLE │ ACTIONS      │ │
│ │────┼──────┼───────┼──────┼──────────────│ │
│ │ 01 │ ...  │ ...   │ ...  │ Edit Delete  │ │
│ │ 02 │ ...  │ ...   │ ...  │ Edit Delete  │ │
│ └──────────────────────────────────────────┘ │
│                                              │
└──────────────────────────────────────────────┘
```

Use generous spacing.

Avoid overly dense layouts.

---

# Header

Create a compact technical header.

Possible visual content:

```text
USER MANAGEMENT
SYSTEM // ADMIN
```

or:

```text
ABM USERS
SYSTEM ONLINE
```

The header should reinforce the system/terminal aesthetic without becoming decorative clutter.

Include a subtle cyan status indicator where appropriate.

Example:

```text
● SYSTEM ONLINE
```

The indicator may have a very subtle pulse animation.

---

# Navigation / Main Controls

Interactive controls should have:

* Clear hover state
* Cyan accent
* Subtle glow
* Smooth transitions
* Visible focus state

Example:

```css
transition:
    background-color 180ms ease,
    border-color 180ms ease,
    box-shadow 180ms ease,
    transform 180ms ease;
```

Avoid excessive animations.

---

# Users Table

The users table is one of the main visual components.

## Table header

Use cyan as the dominant accent.

The header should have:

* Dark cyan-tinted background
* Cyan text
* Technical typography
* Subtle bottom border

Example visual direction:

```text
┌────────┬────────────┬────────────────────┬────────────┬─────────────┐
│ ID     │ USER       │ EMAIL              │ ROLE       │ ACTIONS     │
├────────┼────────────┼────────────────────┼────────────┼─────────────┤
```

Do not make the entire header extremely bright.

---

# Table Rows

Rows should use dark surfaces.

Add a subtle hover effect:

```css
tr:hover {
    background: rgba(0, 212, 255, 0.045);
}
```

The hover should feel smooth and restrained.

Do not move the entire row significantly.

---

# Status Badges

Create modern badges for statuses and roles.

Example:

```text
[ ADMIN ]
[ USER ]
[ ACTIVE ]
```

Use:

* Rounded corners
* Small font
* JetBrains Mono
* Subtle border
* Slight background tint

Example:

```css
.badge {
    font-family: "JetBrains Mono", monospace;
    font-size: 0.72rem;
    border: 1px solid rgba(0, 212, 255, 0.3);
    background: rgba(0, 212, 255, 0.08);
}
```

---

# Animated Status Badges

Some status badges may have a very subtle animation.

For example:

```text
● ACTIVE
```

The indicator can softly pulse.

Keep the animation slow and subtle.

Do not continuously animate entire badges.

Respect:

```css
@media (prefers-reduced-motion: reduce) {
    * {
        animation-duration: 0.01ms;
        animation-iteration-count: 1;
        transition-duration: 0.01ms;
    }
}
```

---

# Create User Form

The "New User" form should feel like a technical system interface.

Use a dark panel with:

* Clear sections
* Labels
* Consistent spacing
* Cyan focus states
* Subtle borders
* Clear buttons

Example:

```text
┌──────────────────────────────────────┐
│ NEW USER                             │
│ CREATE SYSTEM ACCOUNT                │
│                                      │
│ NAME                                 │
│ ┌──────────────────────────────────┐ │
│ │ Enter name...                    │ │
│ └──────────────────────────────────┘ │
│                                      │
│ LAST NAME                            │
│ ┌──────────────────────────────────┐ │
│ │ Enter last name...               │ │
│ └──────────────────────────────────┘ │
│                                      │
│ EMAIL                                │
│ ┌──────────────────────────────────┐ │
│ │ user@example.com                 │ │
│ └──────────────────────────────────┘ │
│                                      │
│ ROLE                                 │
│ ┌──────────────────────────────────┐ │
│ │ Select role                     ▼│ │
│ └──────────────────────────────────┘ │
│                                      │
│              [ CREATE USER ]         │
└──────────────────────────────────────┘
```

---

# Form Inputs

Inputs should have:

* Dark background
* Subtle border
* Light text
* Rounded corners
* Smooth transition

Normal:

```css
border: 1px solid var(--border);
```

Focus:

```css
border-color: var(--accent-cyan);

box-shadow:
    0 0 0 2px rgba(0, 212, 255, 0.08),
    0 0 15px rgba(0, 212, 255, 0.12);
```

The focus effect should make the input appear to "activate" or glow.

Do not make the glow excessive.

---

# Buttons

Primary buttons should use the cyan accent.

Example:

```text
+ NEW USER
CREATE USER
SAVE CHANGES
```

Use:

* Cyan border
* Cyan text or dark text depending on contrast
* Subtle glow
* Hover transition

Secondary buttons should be more neutral.

Example:

```text
CANCEL
BACK
```

Danger actions such as Delete should use the error color.

---

# Delete Action

Delete must be visually distinguishable from normal actions.

Use a subtle red accent.

Do not make the entire button bright red by default.

Example:

```text
DELETE
```

Normal:

```css
color: var(--error);
border-color: rgba(255, 77, 103, 0.25);
```

Hover:

Increase the red background tint and border visibility.

---

# Edit Action

Edit buttons should use the primary cyan accent.

Example:

```text
EDIT
```

Use a small glow on hover.

---

# Alerts

Create modern success and error alerts.

## Success

Example:

```text
┌─────────────────────────────────────────┐
│ ✓ USER CREATED SUCCESSFULLY             │
└─────────────────────────────────────────┘
```

Use:

* Green border
* Very subtle green background
* Green icon/accent
* Dark surface

Example:

```css
border: 1px solid rgba(53, 230, 154, 0.35);
background: rgba(53, 230, 154, 0.06);
```

## Error

Example:

```text
┌─────────────────────────────────────────┐
│ ! AN ERROR OCCURRED                     │
└─────────────────────────────────────────┘
```

Use:

```css
border: 1px solid rgba(255, 77, 103, 0.35);
background: rgba(255, 77, 103, 0.06);
```

Alerts should not use large solid-color backgrounds.

---

# Cards / Panels

Use dark panels with subtle borders.

Example:

```css
.panel {
    background: var(--bg-surface);
    border: 1px solid var(--border);
    border-radius: 12px;
}
```

Add a very subtle shadow.

Avoid excessive glassmorphism.

The interface should remain readable and professional.

---

# Responsive Design

The redesign must remain fully responsive.

Desktop:

* Full-width table
* Comfortable spacing
* Horizontal controls

Tablet:

* Reduce spacing
* Allow horizontal table scrolling if necessary

Mobile:

* Stack buttons
* Forms become one column
* Table should remain usable
* Avoid breaking the layout

Do not simply hide important information on mobile.

---

# Accessibility

Maintain good accessibility.

Requirements:

* Semantic HTML
* Proper `<label>` elements
* Keyboard navigation
* Visible focus states
* Sufficient text contrast
* Buttons must have clear text
* Do not rely exclusively on color
* Respect `prefers-reduced-motion`

The cyan glow must never replace a visible focus indicator.

---

# Animations

Use subtle animations only.

Recommended:

* Button hover
* Input focus
* Table row hover
* Badge pulse
* Alert appearance
* Small panel transitions

Avoid:

* Excessive flashing
* Constant movement
* Large transforms
* Full-screen animations
* Distracting particle effects

The interface should feel responsive, not animated for the sake of animation.

---

# Technical Constraints

## Do not change backend behavior

Do NOT modify:

* Database schema
* SQL structure
* CRUD logic
* Controller behavior
* Model behavior
* Database connection behavior
* Routes
* Form actions
* Existing GET/POST parameters

unless a change is strictly required to support the visual redesign.

---

## Preserve existing functionality

After the redesign, these operations must continue working:

* List users
* Create users
* Edit users
* Delete users
* Assign roles
* Display success messages
* Display error messages

Test all existing operations after modifying the frontend.

---

# CSS Organization

Keep styling organized.

Prefer:

```text
frontend/
└── css/
    └── styles.css
```

If the existing project already uses multiple CSS files, preserve the structure where practical.

Use CSS variables for the theme.

Example:

```css
:root {
    --bg-primary: #080c14;
    --bg-secondary: #0d1420;
    --bg-surface: #111927;

    --accent-cyan: #00d4ff;

    --success: #35e69a;
    --error: #ff4d67;
    --warning: #ffb84d;

    --text-primary: #e8f1f7;
    --text-secondary: #8c9aaa;

    --border: rgba(130, 170, 200, 0.15);
}
```

---

# Fonts

Use Google Fonts if the project currently allows external font loading.

Recommended:

```text
Outfit
JetBrains Mono
```

Use:

```css
font-family: "Outfit", sans-serif;
```

for general content.

Use:

```css
font-family: "JetBrains Mono", monospace;
```

for technical data.

If external font loading is not appropriate, provide sensible system fallbacks.

---

# Visual Identity

The final interface should communicate:

```text
SYSTEM
DATABASE
USERS
CONTROL
STATUS
```

without literally filling the interface with those words.

Think of a modern developer-oriented administration system.

Desired impression:

> "This is a real technical system used to manage application data."

Not:

> "This is a cyberpunk-themed website."

---

# Final Checklist

Before finishing the redesign, verify:

* [ ] Background is approximately `#080c14`
* [ ] Subtle terminal/grid overlay exists
* [ ] Cyan accent is approximately `#00d4ff`
* [ ] Cyan glow is used selectively
* [ ] Outfit is used for general UI
* [ ] JetBrains Mono is used for technical information
* [ ] User table has a cyan-accented header
* [ ] Table rows have subtle hover feedback
* [ ] Roles/statuses use badges
* [ ] Status badges have restrained animation
* [ ] New User form has glowing focus states
* [ ] Success alerts have subtle green borders
* [ ] Error alerts have subtle red borders
* [ ] Buttons have clear hover/focus states
* [ ] Delete actions are visually distinct
* [ ] Layout is responsive
* [ ] Accessibility is preserved
* [ ] Reduced-motion preference is supported
* [ ] Existing CRUD functionality remains unchanged
* [ ] No database changes were introduced
* [ ] No unnecessary backend changes were introduced

## Important

Do not replace the current application with a new implementation.

Modify the existing frontend and CSS while preserving the current PHP architecture and functionality.

The goal is a **visual redesign**, not a rewrite of the application.
