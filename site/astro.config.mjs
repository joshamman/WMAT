// @ts-check
import { defineConfig } from 'astro/config';
import sitemap from '@astrojs/sitemap';

/**
 * Open EXTERNAL links inside Markdown content (blog posts) in a new tab.
 * Internal links (relative, anchors, or our own domain) stay in the same tab.
 * Markdown is only used for blog posts, so this is scoped to post bodies.
 */
function rehypeExternalLinksNewTab() {
  return (tree) => {
    const walk = (node) => {
      if (node.type === 'element' && node.tagName === 'a' && typeof node.properties?.href === 'string') {
        const href = node.properties.href;
        const isExternal = /^https?:\/\//i.test(href) && !href.includes('westmichiganarttherapy.com');
        if (isExternal) {
          node.properties.target = '_blank';
          node.properties.rel = 'noopener noreferrer';
        }
      }
      node.children?.forEach(walk);
    };
    walk(tree);
  };
}

// https://astro.build
export default defineConfig({
  site: 'https://westmichiganarttherapy.com',
  integrations: [
    sitemap({
      // /thanks/ is a post-submit utility page (also carries a noindex meta).
      filter: (page) => !page.includes('/thanks/'),
      // Deploys are manual and only happen when content changed, so the
      // build date is an honest lastmod for every page.
      lastmod: new Date(),
    }),
  ],
  markdown: {
    rehypePlugins: [rehypeExternalLinksNewTab],
  },
});
