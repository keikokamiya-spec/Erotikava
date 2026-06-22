# Event Calendar WP Scaffold

This folder prepares only the event calendar section for a future WordPress migration using:

- custom post type: `event_calendar`
- ACF fields for date, image, and status
- a monthly 7-column calendar renderer

## Files

- `register-event-calendar.php`
  Registers the custom post type and local ACF field group.
- `render-event-calendar.php`
  Renders the current month as a 7-column calendar using the same class names as the current static site.
- `page-events.php`
  Example page template that drops the renderer into the existing event page layout.

## How To Use In A Theme

Add these includes from your theme `functions.php`:

```php
require_once get_template_directory() . '/wordpress/event-calendar/register-event-calendar.php';
require_once get_template_directory() . '/wordpress/event-calendar/render-event-calendar.php';
```

Move `page-events.php` into the active theme root if you want it to appear as a selectable page template.

## Data Model

One WordPress post equals one calendar day.

- post type: `event_calendar`
- title: recommended format `2026-07-14`
- ACF fields:
  - `event_date`
  - `event_status`
  - `event_image`
  - `event_note`

## Behavior

- The month and year are derived from the current date by default.
- The renderer automatically builds the correct 7-column layout for the current month.
- Empty days fall back to a `TBA` card.
- Existing front-end search JS can keep working because the output reuses:
  - `.calendar-event-card`
  - `data-event-date`
  - `data-event-status`

## Notes

- This repo is still a static site, so these files are scaffolding only.
- The current static `reservations.html` is not automatically wired to these PHP files until the site is migrated into WordPress.
