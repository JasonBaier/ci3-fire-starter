<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<?php echo '<?xml version="1.0" encoding="UTF-8" ?>' ?>
<urlset
      xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
      xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
      xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9
            http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">
    <url>
        <loc><?php echo base_url(); ?></loc>
        <changefreq>weekly</changefreq>
        <priority>1.0</priority>
    </url>
    <url>
        <loc><?php echo base_url('contact'); ?></loc>
        <changefreq>weekly</changefreq>
        <priority>0.5</priority>
    </url>
</urlset>
