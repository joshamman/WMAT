/**
 * Service areas — the single source of truth for city landing pages, the
 * /service-areas/ hub, the lakeshore map, footers, home-page pills, llms.txt,
 * and structured data.
 *
 * Copy rules (SEO + honesty):
 *  - Every intro is written around a DISTINCT local angle — never a template
 *    with the city name swapped.
 *  - Amy has ONE studio (West Olive). Copy says "serving / traveling to /
 *    online for" — never "our {city} office/location".
 *  - Drive times are friendly estimates from West Olive, not promises.
 */

export interface ServiceArea {
  slug: string; // '/art-therapy-{slug}/'
  name: string;
  county: string;
  title: string; // <title>, ≤60 chars
  metaDescription: string; // unique, ~130–155 chars
  headline: string; // h1
  hook: string; // one-liner for hub cards + map preview
  intro: string[]; // 2–3 paragraphs of genuinely local copy
  driveNote: string; // sentence about getting to the studio
  driveMinutes: number; // approximate, for the map label
  nearby: string[]; // also-served towns folded into this page
  faqs: { q: string; a: string }[];
  /** Optional deeper-dive link (e.g. a related blog post). */
  related?: { label: string; href: string };
  /** Stylized position on the lakeshore map (viewBox 0 0 1000 800) + brand accent. */
  map: { x: number; y: number; accent: string };
}

/** Amy's studio on the map (stylized coords, not geography). */
export const STUDIO = { x: 400, y: 440 };
export const MAP_W = 1000;
export const MAP_H = 800;

export const counties = ['Ottawa County', 'Kent County', 'Muskegon County', 'Allegan County'];

export const serviceAreas: ServiceArea[] = [
  {
    slug: 'grand-rapids',
    name: 'Grand Rapids',
    county: 'Kent County',
    title: 'Art Therapy in Grand Rapids, MI | West Michigan Art Therapy',
    metaDescription:
      'Art therapy for Grand Rapids: online sessions, plus workshops and presentations that travel to Kent County teams, from a board-certified art therapist.',
    headline: 'Art therapy in Grand Rapids',
    hook: 'Workshops and presentations travel to your team; individual sessions meet you online.',
    intro: [
      'Grand Rapids has no shortage of creative energy — what West Michigan Art Therapy adds is the clinical side: a board-certified art therapist (ATR-BC) who uses the creative process, within a confidential therapeutic relationship, to support real mental-health goals.',
      'For the metro’s nonprofits, schools, healthcare teams, and workplaces, Amy travels to you. Workshops are built around your group’s needs — team-building, burnout and stress, grief in caregiving professions — and presentations pair evidence-based content with hands-on making, so your people leave having experienced the work, not just heard about it.',
      'Individuals in Grand Rapids most often meet Amy online — sessions work beautifully over video with materials you already have at home. And when a drive to the lakeshore sounds like part of the therapy, the West Olive studio is about forty minutes west, straight toward the water.',
    ],
    driveNote:
      'The West Olive studio is about a 40-minute drive west of downtown Grand Rapids — most Grand Rapids clients choose online sessions, and workshops come to you.',
    driveMinutes: 40,
    nearby: [],
    faqs: [
      {
        q: 'Do you travel to Grand Rapids for workshops and presentations?',
        a: 'Yes. Workshops ($200–350) and educational presentations ($150–200) are customized and delivered on-site for organizations, teams, and groups across the Grand Rapids area, or online if you prefer.',
      },
      {
        q: 'Can I do individual art therapy from Grand Rapids?',
        a: 'Absolutely — individual sessions ($100, sliding scale available) are offered online across Michigan, or in person at the West Olive studio, about 40 minutes west of the city.',
      },
      {
        q: 'Do I need art experience for a workplace workshop?',
        a: 'None at all. Every activity is designed for complete beginners — the point is the process and the conversation it opens, never the product.',
      },
    ],
    map: { x: 790, y: 400, accent: 'var(--sage-500)' },
  },
  {
    slug: 'holland',
    name: 'Holland',
    county: 'Ottawa County',
    title: 'Art Therapy in Holland, MI | West Michigan Art Therapy',
    metaDescription:
      'Art therapy near Holland, MI — in-person sessions twenty minutes up the shore in West Olive, online options, and all-ages support from an ATR-BC therapist.',
    headline: 'Art therapy near Holland',
    hook: 'Twenty minutes up the shore from Tulip City — the studio’s nearest neighbor.',
    intro: [
      'Holland is the studio’s nearest city neighbor — about twenty minutes down the shoreline — which makes in-person art therapy genuinely easy: close enough for an after-school appointment, far enough that the drive up the coast becomes a little decompression of its own.',
      'Families are a big part of this stretch of the lakeshore. Amy works with children, adolescents, and adults in a person-centered way: kids who don’t yet have words for big feelings often find them in paint and clay first, and teens tend to appreciate a therapy hour that doesn’t require sitting on a couch making eye contact. No one needs to be “good at art.”',
      'Individual sessions offer a sliding scale, group sessions run in small supportive circles, and everything is also available online when getting to West Olive doesn’t fit the week.',
    ],
    driveNote:
      'From Holland, the West Olive studio is about 20 minutes north along the shore — an easy after-school or after-work drive.',
    driveMinutes: 20,
    nearby: [],
    faqs: [
      {
        q: 'How far is the studio from Holland?',
        a: 'About 20 minutes north along the lakeshore, in West Olive. Online sessions are always available as an alternative.',
      },
      {
        q: 'Do you work with children and teens?',
        a: 'Yes — children, adolescents, adults, and older adults. Sessions are person-centered and paced to each client; no art skill is ever required.',
      },
      {
        q: 'Is there flexible pricing for families?',
        a: 'Individual sessions ($100) offer a sliding scale — just ask. Cash, check, and PayPal are welcome; insurance is not currently accepted.',
      },
    ],
    map: { x: 420, y: 560, accent: 'var(--gold-400)' },
  },
  {
    slug: 'muskegon',
    name: 'Muskegon',
    county: 'Muskegon County',
    title: 'Art Therapy in Muskegon, MI | West Michigan Art Therapy',
    metaDescription:
      'Art therapy for Muskegon and Norton Shores — grief and end-of-life support, legacy artwork, and all-ages sessions from a board-certified art therapist.',
    headline: 'Art therapy in Muskegon',
    hook: 'Hospice, grief, and legacy artwork — Amy’s other home shore.',
    intro: [
      'Muskegon holds a special place in this practice: alongside West Michigan Art Therapy, Amy serves as an art therapist in hospice care in the Muskegon area, sitting bedside with patients and families to make things that say what words can’t — memory pieces, painted keepsakes, legacy artwork that stays with a family long after.',
      'That end-of-life and grief experience shapes what she offers Muskegon and Norton Shores more broadly: support for people carrying loss, caregivers running on empty, and older adults who want to put a life’s story into something you can hold. Grief doesn’t follow a schedule, and neither does the way it comes out — art gives it somewhere to go.',
      'Sessions happen online, at the West Olive studio about thirty-five minutes south along the shore, and — for organizations, senior communities, and care teams — as workshops and presentations that come to you.',
    ],
    driveNote:
      'From Muskegon or Norton Shores, the studio is roughly 35 minutes south on the shoreline route — or meet online.',
    driveMinutes: 35,
    nearby: ['Norton Shores'],
    faqs: [
      {
        q: 'Do you provide art therapy in hospice settings?',
        a: 'Yes. Amy works as an art therapist in hospice care in the Muskegon area, creating legacy pieces with patients and families at the bedside. You can read about that work on the blog.',
      },
      {
        q: 'What is a legacy piece?',
        a: 'A work of art made near the end of life — a painting, a keepsake, sometimes a collaboration between a patient and their family — that honors a life and a relationship, and stays with the family.',
      },
      {
        q: 'Do you see clients from Norton Shores?',
        a: 'Yes — Norton Shores, Muskegon, and the surrounding Muskegon County area, in person at the West Olive studio, online, or via workshops that travel to your organization.',
      },
    ],
    related: {
      label: 'Read: Making something from the heart — art therapy in hospice care',
      href: '/blog/hospice-art-therapy-harbor/',
    },
    map: { x: 395, y: 150, accent: 'var(--sky-400, #5DA8CC)' },
  },
  {
    slug: 'grand-haven',
    name: 'Grand Haven',
    county: 'Ottawa County',
    title: 'Art Therapy in Grand Haven, MI | West Michigan Art Therapy',
    metaDescription:
      'Art therapy for Grand Haven, Spring Lake & Ferrysburg — the studio is fifteen minutes down the shore in West Olive. All ages, in person or online.',
    headline: 'Art therapy in Grand Haven',
    hook: 'The Tri-Cities — the closest stretch of shore to the studio.',
    intro: [
      'Grand Haven, Spring Lake, and Ferrysburg are the closest towns to the studio — about fifteen minutes up the coast — so if you’ve been wanting therapy that happens in person, at a table with real materials, this is the easiest stretch of shoreline to do it from.',
      'The Tri-Cities bring Amy the widest range of ages of anywhere she serves: young children sorting out big feelings, teens navigating pressure and identity, adults in transition, and older adults reflecting on a full life. Art therapy meets each of them differently — same table, same warm room, very different journeys. It is real, master’s-level mental-health care; it just happens to use paint as well as words.',
      'Group sessions are a local favorite — ninety minutes of guided, themed creating in a small circle — and individual sessions offer a sliding scale so cost doesn’t have to be the deciding factor.',
    ],
    driveNote:
      'From Grand Haven, Spring Lake, or Ferrysburg, the West Olive studio is about 15 minutes south along US-31.',
    driveMinutes: 15,
    nearby: ['Spring Lake', 'Ferrysburg'],
    faqs: [
      {
        q: 'Where do sessions happen if I live in Grand Haven?',
        a: 'Most Tri-Cities clients come to the West Olive studio, about 15 minutes south. Every session type is also available online.',
      },
      {
        q: 'Do you work with older adults?',
        a: 'Yes — including life-review and legacy artwork, grief support, and gentle, adaptive approaches for changing abilities.',
      },
      {
        q: 'What happens in a group session?',
        a: 'Ninety minutes of collective creativity in a small, supportive circle ($150) — structured, themed activities with room for whatever comes up along the way.',
      },
    ],
    map: { x: 390, y: 320, accent: 'var(--teal-500, #2E8B8C)' },
  },
  {
    slug: 'saugatuck',
    name: 'Saugatuck',
    county: 'Allegan County',
    title: 'Art Therapy in Saugatuck, MI | West Michigan Art Therapy',
    metaDescription:
      'Art therapy on Michigan’s Art Coast — serving Saugatuck & Douglas with person-centered sessions, in person near West Olive or online.',
    headline: 'Art therapy on the Art Coast',
    hook: 'Saugatuck & Douglas — where the Art Coast meets art as therapy.',
    intro: [
      'Saugatuck and Douglas are literally nicknamed “the Art Coast of Michigan” — a shoreline of galleries, studios, and people who already know that making things matters. Art therapy is the other side of that coin: not art for exhibition, but art as a clinical, confidential path through what’s heavy. Same materials, completely different purpose.',
      'That distinction matters here more than anywhere. Practicing artists sometimes assume therapy through art can’t offer them anything new — then discover how different it feels to make something no one will critique, price, or even see. And people who’d never call themselves artists find the Art Coast’s spirit is for them, too: in art therapy there is no wrong mark.',
      'Amy sees Saugatuck and Douglas clients online and at the West Olive studio, about half an hour up the lakeshore, and brings workshops to galleries, organizations, and groups along the south shore.',
    ],
    driveNote:
      'From Saugatuck or Douglas, the studio is about 30 minutes north up the lakeshore — or meet online.',
    driveMinutes: 30,
    nearby: ['Douglas'],
    faqs: [
      {
        q: 'I’m already an artist — would art therapy still offer me anything?',
        a: 'Often more than you’d expect. Working with a board-certified art therapist is nothing like studio practice or critique: the work is confidential, process-focused, and aimed at your wellbeing, not a finished piece.',
      },
      {
        q: 'Is art therapy just a guided art class?',
        a: 'No — art therapy is a master’s-level mental health profession combining psychotherapy and the creative process within a professional, confidential relationship. It is not arts and crafts.',
      },
      {
        q: 'Do you offer workshops on the south shore?',
        a: 'Yes — customized workshops ($200–350) and presentations ($150–200) for galleries, organizations, and community groups around Saugatuck, Douglas, and greater Allegan County.',
      },
    ],
    map: { x: 430, y: 690, accent: 'var(--clay-500, #A66E3D)' },
  },
];

/** Additional towns highlighted in copy but folded into a parent page. */
export const supportingTowns = serviceAreas.flatMap((a) => a.nearby);

/**
 * Zoomed viewBox for a city — frames the studio, the city, and the painted
 * route between them, at the map's 5:4 aspect. Returns [x, y, w, h].
 */
export function focusBox(area: ServiceArea): [number, number, number, number] {
  const pad = 150;
  const minX = Math.min(STUDIO.x, area.map.x) - pad;
  const maxX = Math.max(STUDIO.x, area.map.x) + pad;
  const minY = Math.min(STUDIO.y, area.map.y) - pad;
  const maxY = Math.max(STUDIO.y, area.map.y) + pad;
  let w = Math.max(maxX - minX, 480);
  let h = Math.max(maxY - minY, 384);
  const ratio = MAP_W / MAP_H; // 1.25
  if (w / h > ratio) h = w / ratio;
  else w = h * ratio;
  const cx = (minX + maxX) / 2;
  const cy = (minY + maxY) / 2;
  return [round1(cx - w / 2), round1(cy - h / 2), round1(w), round1(h)];
}

/** A gently bowed painterly route from the studio to a city (bows inland). */
export function routePath(area: ServiceArea): string {
  const from = STUDIO;
  const to = area.map;
  const mx = (from.x + to.x) / 2;
  const my = (from.y + to.y) / 2;
  const dx = to.x - from.x;
  const dy = to.y - from.y;
  const len = Math.hypot(dx, dy) || 1;
  const k = len * 0.22;
  // Two candidate control points perpendicular to the midpoint; pick the
  // inland (larger-x) one so coastal routes never bow into the lake.
  const c1 = { x: mx + (-dy / len) * k, y: my + (dx / len) * k };
  const c2 = { x: mx - (-dy / len) * k, y: my - (dx / len) * k };
  const c = c1.x >= c2.x ? c1 : c2;
  return `M ${from.x} ${from.y} Q ${round1(c.x)} ${round1(c.y)} ${to.x} ${to.y}`;
}

/** Point ~60% along the route, toward the city (for the drive-time label —
 *  keeps it clear of the studio's own labels). */
export function routeMidpoint(area: ServiceArea): { x: number; y: number } {
  const m = routePath(area).match(/Q ([\d.]+) ([\d.]+) ([\d.]+) ([\d.]+)/);
  const from = STUDIO;
  const to = area.map;
  const c = m ? { x: Number(m[1]), y: Number(m[2]) } : { x: (from.x + to.x) / 2, y: (from.y + to.y) / 2 };
  const t = 0.6;
  const [a, b, d] = [(1 - t) ** 2, 2 * t * (1 - t), t ** 2];
  return {
    x: round1(a * from.x + b * c.x + d * to.x),
    y: round1(a * from.y + b * c.y + d * to.y),
  };
}

const round1 = (n: number) => Math.round(n * 10) / 10;
