# DanhThong Print Design Upload

Let customers upload an image, position it on a product canvas, and save the final design with the cart/order in WooCommerce.

## Description

DanhThong Print Design Upload adds a simple product customizer to WooCommerce products.

**Features**
- Enable/disable design upload per product.
- Customer uploads an image on the product page.
- The uploaded image is added as a movable/resizable layer on a canvas (Fabric.js).
- The product image can be used as the canvas background.
- **NEW (v1.0.1): Clip mask support to restrict the editable design area.**
- Visual overlay frame to clearly indicate the allowed design region.
- The final merged design is exported as PNG and stored with the cart item.
- Design files can be displayed in the admin order screen (per order item).
- Lightweight lightbox support for viewing uploaded images.

This plugin is designed for stores that sell personalized products (e.g., t-shirts, mugs, phone cases, posters).

---

## Clip Mask (New in v1.0.1)

Starting from **version 1.0.1**, you can optionally upload a **clip mask image** per product to limit where customers can place and preview their designs.

### How it works
- Upload a **PNG clip mask** in the product settings.
- **Transparent area** → allowed design region.
- **Opaque area** → hidden / restricted region.
- Customer images are clipped in real time on the canvas.
- The exported PNG respects the defined clipping boundaries.

This helps ensure designs stay within printable areas and improves print accuracy.

---

## Requirements

- WordPress 6.0+
- WooCommerce (installed and active)
- PHP 7.4+

---

## Installation

1. Upload the plugin folder to `wp-content/plugins/danhthong-print-design-upload/`
   or install the ZIP via **Plugins → Add New → Upload Plugin**.
2. Activate the plugin through the **Plugins** screen in WordPress.
3. Make sure WooCommerce is installed and active.

---

## Usage

1. Go to **WooCommerce → Product Design Upload Settings** (`wp-admin/admin.php?page=wcpdu-settings`) and enable the option to allow customers to upload designs.
2. Go to **Products → Edit product**.
3. Enable the design upload option for that product.
4. (Optional) Upload a **Clipping Mask Image** to restrict the editable area.
5. On the product page, click the **Customize** button.
6. Upload an image, move/scale it within the allowed area, then click **Apply**.
7. Add to cart. The merged PNG is saved and attached to the cart item and order item meta.

---

## FAQ

### Does this plugin require WooCommerce?
Yes. WooCommerce must be installed and active.

### What is a clip mask?
A clip mask is a PNG image that defines where customers are allowed to design. Transparent areas allow design, while opaque areas hide content outside the printable region.

### Does the clip mask affect the exported image?
Yes. The exported PNG is clipped to the defined mask, ensuring only the allowed area is included.

### Where are uploaded/generated files stored?
Files are stored under the WordPress uploads directory. The plugin uses a dedicated subfolder for design assets.

### Does this work with WooCommerce zoom/lightbox?
Yes. The plugin updates the product gallery image and attempts to refresh zoom overlays (including `.zoomImg` used by some themes/plugins).

### Can I allow multiple uploaded layers?
Currently the customizer is intended for a single uploaded image layer. You can extend it to allow multiple layers if needed.

---

## Screenshots

1. Customize button on the product page.
2. Customizer modal with canvas and uploaded image layer.
3. Design area restricted using a clip mask (v1.0.1).
4. Admin order screen showing uploaded design files per line item.

---

## Changelog

### 1.0.1
- Added clip mask support to restrict editable design areas.
- Added product-level clip mask upload field.
- Improved canvas rendering with visual overlay frame.
- Ensured exported images respect clipping boundaries.

### 1.0.0
- Initial release.

---

## License

GPL-2.0-or-later. See `LICENSE`.
