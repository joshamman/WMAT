/**
 * JSON-LD (schema.org) node builders — the single source of truth for the
 * site's structured data. BaseLayout emits business() + person() on every
 * page; pages pass extra nodes (FAQ, BlogPosting, Service, breadcrumbs)
 * through the `schema` prop. Each node renders as its own <script> block;
 * `@id` cross-references resolve across blocks.
 *
 * PRIVACY: the practice publishes a city-level address only — never add
 * telephone, streetAddress, or geo coordinates here.
 */

export const SITE = 'https://westmichiganarttherapy.com';
export const BUSINESS_ID = `${SITE}/#business`;
export const PERSON_ID = `${SITE}/#amy-rostollan-hamman`;

const abs = (path: string) => new URL(path, SITE).href;

/** Cities named as served (in-person); supporting towns included. */
export const CITIES_SERVED = [
  'West Olive',
  'Grand Rapids',
  'Holland',
  'Muskegon',
  'Grand Haven',
  'Saugatuck',
  'Spring Lake',
  'Norton Shores',
  'Ferrysburg',
  'Douglas',
];

export const COUNTIES_SERVED = ['Ottawa County', 'Kent County', 'Muskegon County', 'Allegan County'];

const offer = (name: string, description: string, price: Record<string, unknown>) => ({
  '@type': 'Offer',
  itemOffered: { '@type': 'Service', name, description, serviceType: 'Art therapy' },
  ...price,
});

export function business(): Record<string, unknown> {
  return {
    '@context': 'https://schema.org',
    '@type': ['LocalBusiness', 'ProfessionalService', 'MedicalBusiness'],
    '@id': BUSINESS_ID,
    name: 'West Michigan Art Therapy',
    slogan: 'Heal through creativity',
    description:
      'Board-certified art therapy for all ages on the West Michigan lakeshore — individual and group sessions, workshops, supervision, and presentations, online or in person.',
    url: `${SITE}/`,
    email: 'amy@westmichiganarttherapy.com',
    image: abs('/assets/images/og-default.png'),
    logo: abs('/assets/images/logo.svg'),
    priceRange: '$75-$350',
    // City-level only, by design (Amy works from home — privacy).
    address: { '@type': 'PostalAddress', addressLocality: 'West Olive', addressRegion: 'MI', addressCountry: 'US' },
    areaServed: [
      ...CITIES_SERVED.map((name) => ({ '@type': 'City', name })),
      ...COUNTIES_SERVED.map((name) => ({ '@type': 'AdministrativeArea', name })),
      { '@type': 'State', name: 'Michigan' },
    ],
    knowsAbout: [
      'art therapy',
      'hospice and end-of-life care',
      'legacy artwork',
      'grief support',
      'trauma-informed care',
      'strengths-based therapy for youth in the juvenile justice system',
      'clinical supervision for art therapists',
      'telehealth art therapy',
    ],
    hasOfferCatalog: {
      '@type': 'OfferCatalog',
      name: 'Art therapy services',
      itemListElement: [
        offer('Individual Sessions', 'One-on-one art therapy, 45–60 minutes, personalized approach.', {
          price: '100',
          priceCurrency: 'USD',
        }),
        offer('Group Sessions', 'Ninety minutes of collective creativity in a small, supportive circle.', {
          price: '150',
          priceCurrency: 'USD',
        }),
        offer('Workshops', 'Team-building and comprehensive programming, customized to your group.', {
          priceSpecification: { '@type': 'PriceSpecification', minPrice: 200, maxPrice: 350, priceCurrency: 'USD' },
        }),
        offer('Online Supervision', 'Clinical case consultation and professional development for art therapists.', {
          priceSpecification: { '@type': 'UnitPriceSpecification', price: 75, priceCurrency: 'USD', unitText: 'hour' },
        }),
        offer('Presentations', 'Customized, evidence-based content with interactive components.', {
          priceSpecification: { '@type': 'PriceSpecification', minPrice: 150, maxPrice: 200, priceCurrency: 'USD' },
        }),
      ],
    },
    founder: { '@id': PERSON_ID },
    employee: { '@id': PERSON_ID },
    sameAs: [
      'https://www.facebook.com/WestMichiganArtTherapy',
      'https://www.linkedin.com/in/amy-rostollan-hamman-b386ba86/',
    ],
  };
}

export function person(): Record<string, unknown> {
  return {
    '@context': 'https://schema.org',
    '@type': 'Person',
    '@id': PERSON_ID,
    name: 'Amy Rostollan-Hamman',
    jobTitle: 'Board-Certified Art Therapist (ATR-BC)',
    image: abs('/assets/images/amy-pittsburgh.jpg'),
    worksFor: { '@id': BUSINESS_ID },
    hasCredential: {
      '@type': 'EducationalOccupationalCredential',
      credentialCategory: 'Board Certification',
      name: 'ATR-BC — Board Certified Registered Art Therapist',
      recognizedBy: { '@type': 'Organization', name: 'Art Therapy Credentials Board', url: 'https://www.atcb.org/' },
    },
    knowsAbout: ['art therapy', 'hospice and end-of-life care', 'trauma-informed care', 'clinical supervision'],
    sameAs: ['https://www.linkedin.com/in/amy-rostollan-hamman-b386ba86/'],
  };
}

export function faqPage(items: { q: string; a: string }[]): Record<string, unknown> {
  return {
    '@context': 'https://schema.org',
    '@type': 'FAQPage',
    mainEntity: items.map(({ q, a }) => ({
      '@type': 'Question',
      name: q,
      acceptedAnswer: { '@type': 'Answer', text: a },
    })),
  };
}

export function breadcrumbs(crumbs: { name: string; url: string }[]): Record<string, unknown> {
  return {
    '@context': 'https://schema.org',
    '@type': 'BreadcrumbList',
    itemListElement: crumbs.map(({ name, url }, i) => ({
      '@type': 'ListItem',
      position: i + 1,
      name,
      item: url,
    })),
  };
}

export function blogPosting(opts: {
  title: string;
  description: string;
  url: string;
  datePublished: Date;
  dateModified?: Date;
  image?: string;
}): Record<string, unknown> {
  return {
    '@context': 'https://schema.org',
    '@type': 'BlogPosting',
    headline: opts.title,
    description: opts.description,
    url: opts.url,
    mainEntityOfPage: { '@type': 'WebPage', '@id': opts.url },
    datePublished: opts.datePublished.toISOString(),
    dateModified: (opts.dateModified ?? opts.datePublished).toISOString(),
    ...(opts.image ? { image: abs(opts.image) } : {}),
    author: { '@id': PERSON_ID },
    publisher: { '@id': BUSINESS_ID },
    inLanguage: 'en-US',
  };
}

/** Service node for a city landing page — areaServed semantics, never a branch location. */
export function cityService(opts: {
  name: string;
  nearby: string[];
  url: string;
  description: string;
}): Record<string, unknown> {
  return {
    '@context': 'https://schema.org',
    '@type': 'Service',
    name: `Art therapy in ${opts.name}, Michigan`,
    serviceType: 'Art therapy',
    description: opts.description,
    url: opts.url,
    provider: { '@id': BUSINESS_ID },
    areaServed: [opts.name, ...opts.nearby].map((name) => ({ '@type': 'City', name })),
  };
}
