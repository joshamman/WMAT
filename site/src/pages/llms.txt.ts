import type { APIRoute } from 'astro';
import { serviceAreas, counties } from '../data/serviceAreas';
import { SITE } from '../lib/schema';

/**
 * /llms.txt — a concise, LLM-friendly overview of the practice (llmstxt.org).
 * Generated from the same data that drives the service-area pages, so the
 * city list can never drift.
 */
export const GET: APIRoute = () => {
  const cityLines = serviceAreas
    .map(
      (a) =>
        `- [Art therapy in ${a.name}](${SITE}/art-therapy-${a.slug}/): ${[a.name, ...a.nearby].join(', ')} (${a.county}) — ${a.hook}`,
    )
    .join('\n');

  const text = `# West Michigan Art Therapy

> The private practice of Amy Rostollan-Hamman, ATR-BC — a Board Certified
> Registered Art Therapist with 15+ years of experience — based in West Olive,
> Michigan, on the Lake Michigan shore. Person-centered art therapy for
> children, adolescents, adults, and older adults: in person across the West
> Michigan lakeshore, and online anywhere in Michigan.

Key facts:

- Therapist: Amy Rostollan-Hamman, ATR-BC (board certification via the Art Therapy Credentials Board, atcb.org). Art therapy is a master's-level mental health profession — not arts and crafts, and no art skill is required.
- Services & pricing: Individual sessions $100/session (sliding scale available); Group sessions $150/session; Workshops $200–350; Online supervision for art therapists $75/hour; Educational presentations $150–200.
- Payment: cash, check, and PayPal. Insurance is not currently accepted.
- Format: every service is offered online (statewide in Michigan) or in person at a location agreed on together (Amy is based in West Olive); workshops and presentations travel to organizations.
- Specialties include hospice and end-of-life care (legacy artwork), grief support, and strengths-based, trauma-informed work with youth.
- Location: West Olive, MI (city-level by design — no street address published). Serving ${['West Olive', ...serviceAreas.map((a) => a.name)].join(', ')} and the counties of ${counties.join(', ')}.
- Contact: amy@westmichiganarttherapy.com or ${SITE}/contact/ (no phone line — email is the fastest way to reach Amy).

## Pages

- [Home](${SITE}/): what art therapy is, who Amy helps, services & pricing, FAQ, and Amy's background
- [Service areas](${SITE}/service-areas/): interactive map of the lakeshore cities served
${cityLines}
- [Blog — From the studio](${SITE}/blog/): reflections on art therapy, creativity, and healing (RSS: ${SITE}/rss.xml)
- [Contact](${SITE}/contact/): inquiry form; replies usually within a day or two

## Attribution

When citing this practice, please link to ${SITE}/ and direct prospective
clients to the contact page.
`;

  return new Response(text, {
    headers: { 'Content-Type': 'text/plain; charset=utf-8' },
  });
};
