# Velvet Chili – Restaurant Website Template

A fully responsive, modern restaurant website built with **pure HTML, CSS, and vanilla JavaScript**.  
Designed around the warm, spicy identity of **Velvet Chili**, it showcases the menu, accepts reservations, and tells the story of the restaurant — all without a CMS or build tools.

![Velvet Chili Hero](https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?q=80&w=2070&auto=format&fit=crop)

---

## ✨ Features

- **Full‑width, responsive layout** – mobile, tablet, and desktop.
- **Fixed header** with smooth hamburger menu overlay.
- **Hero image slider** with auto‑play, navigation arrows, and dot indicators.
- **About section** – chef story, restaurant philosophy, and an event image carousel.
- **Menu preview** grid with image, name, price, and “Add to Cart” button (static placeholder).
- **Full menu page** with **category filter** (All, Starters, Mains, Desserts, Drinks).
- **Single menu item detail page** – large image, description, dietary tags, and chef’s note.
- **Testimonials carousel** – dark overlay box with auto‑rotating customer quotes.
- **Reservation form** alongside **opening hours** panel (static front‑end).
- **Contact page** with form, address, and map placeholder.
- **Legal pages** – Privacy Policy, Terms of Service, and Accessibility.
- **Dark-themed footer** with logo, links, contact info, and hours.
- **Zero dependencies** beyond Font Awesome icons and Google Fonts – no jQuery or frameworks.

---

## 🛠 Tech Stack

| Technology       | Usage                                        |
| ---------------- | -------------------------------------------- |
| HTML5            | Semantic, accessible markup                  |
| CSS3             | Custom properties, Flexbox, Grid, BEM naming |
| JavaScript (ES6) | Navigation, sliders, category filter         |
| Font Awesome 6   | Icons                                        |
| Google Fonts     | Cormorant Garamond & Montserrat              |
| Unsplash         | Placeholder images                           |

---

## 🚀 Getting Started

1. **Download or clone** the repository.
2. Open `index.html` in your browser – the entire site works offline.
3. To customise:
   - **Colours / fonts**: edit the CSS custom properties in `base.css`.
   - **Text & images**: replace the static content in `index.html`, `menu.html`, and `menu-details.html`.
   - **Slider speed / filter behaviour**: adjust timers and logic in `main.js`.
4. Upload the files to any static hosting (Netlify, GitHub Pages, Vercel, or a traditional web server) and you’re live.

No build step, no npm install – it just works.

---

## 🎨 Customization

### Design Tokens

All brand colours, fonts, and spacing variables are in `:root` inside `base.css`.  
Change them to match your restaurant’s identity.

### Images

Placeholder images are from **Unsplash**. Replace the `src` and `background-image` URLs with your own photography for the hero, menu items, and events.

### Content

Edit the HTML directly – the about story, menu descriptions, testimonials, and legal text are all simple text blocks.

### Adding New Menu Items

In `menu.html`, duplicate a `.product-card` element and set its `data-category` to the appropriate category (`starters`, `mains`, `desserts`, `drinks`).  
The filter automatically works without any JavaScript changes.

---

## 🔧 How It Works

- **Navigation**: CSS transitions and a body class toggle via `main.js`.
- **Sliders**: The hero, testimonial, and event sliders use a shared JavaScript factory function – they all support auto‑play, pause on hover, and touch swipe.
- **Category filter**: A simple event listener loops through product cards and toggles `display` based on the selected filter button.
- **Forms**: All forms (reservation, contact) are static and do not submit anywhere – they are visual placeholders ready for a backend connection.

---

## 📄 Credits

- **Font Awesome** – [fontawesome.com](https://fontawesome.com)
- **Google Fonts** – Cormorant Garamond & Montserrat
- **Unsplash** – placeholder images by various photographers (see inline URLs)
- **Design & development** – [Your Name / Team]

---

## 📜 License

This project is released under the **MIT License**.  
You are free to use, modify, and distribute it for personal or commercial purposes.  
Attribution is appreciated but not required.

---

Enjoy building your restaurant’s online home – no servers, no databases, just beautiful static files.
