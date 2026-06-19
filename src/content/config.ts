// src/content/config.ts
import { defineCollection, z } from 'astro:content';

const portfolioCollection = defineCollection({
  type: 'content', // Dla plików .md i .mdx
  schema: z.object({
    title: z.string(),
    description: z.string(),
    category: z.string(),
    image: z.string().optional(),
    pubDate: z.date().optional(),
  }),
});

export const collections = {
  'portfolio': portfolioCollection,
};