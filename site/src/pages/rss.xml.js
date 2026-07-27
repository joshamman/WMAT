import rss from '@astrojs/rss';
import { getCollection } from 'astro:content';

// Excerpt-only feed for the blog ("From the studio").
export async function GET(context) {
  const posts = (await getCollection('blog', ({ data }) => !data.draft)).sort(
    (a, b) => b.data.date.valueOf() - a.data.date.valueOf(),
  );
  return rss({
    title: 'West Michigan Art Therapy — From the studio',
    description:
      'Reflections on art therapy, creativity, and healing from Amy Rostollan-Hamman, ATR-BC.',
    site: context.site,
    items: posts.map((post) => ({
      title: post.data.title,
      pubDate: post.data.date,
      description: post.data.excerpt,
      link: `/blog/${post.id}/`,
    })),
    customData: '<language>en-us</language>',
  });
}
