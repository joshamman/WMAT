// @ts-check
import { defineConfig } from 'astro/config';
import sitemap from '@astrojs/sitemap';

/**
 * Open every link inside Markdown content (i.e. blog posts) in a new tab.
 * Markdown is only used for blog posts, so this is scoped to post bodies.
 */
function rehypeBlogLinksNewTab() {
  return (tree) => {
    const walk = (node) => {
      if (node.type === 'element' && node.tagName === 'a' && node.properties?.href) {
        node.properties.target = '_blank';
        node.properties.rel = 'noopener noreferrer';
      }
      node.children?.forEach(walk);
    };
    walk(tree);
  };
}

// https://astro.build
export default defineConfig({
  site: 'https://westmichiganarttherapy.com',
  integrations: [sitemap()],
  markdown: {
    rehypePlugins: [rehypeBlogLinksNewTab],
  },
});
