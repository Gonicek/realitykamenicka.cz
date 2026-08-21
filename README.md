# realitykamenicka.cz

WordPress web pro `realitykamenicka.cz`, provozovatelný lokálně přes Docker a produkčně přes Docker Compose na serveru `krkstrc.cz` s URL `realitykamenicka.krkstrc.cz`.

## Lokální spuštění

```bash
cp .env.example .env   # pouze při prvním spuštění; doplň lokální hesla podle potřeby
docker compose up -d
```

Web poběží na:

```text
http://localhost:8087
```

WP-CLI:

```bash
docker compose run --rm wpcli wp option get home --skip-themes --skip-plugins
```

Lokální přihlášení:

- URL: http://localhost:8087/wp-admin
- uživatel: `admin`
- heslo: `local-admin-change-me`

Toto heslo je pouze pro lokální vývoj a nesmí se použít v produkci.

## Produkce

Produkční konfigurace je v `compose.prod.yml`, serverový Caddy snippet v `deploy/Caddyfile.example` a postup v [`docs/deployment.md`](docs/deployment.md).

Automatický deployment se spouští pushem do větve `main` po nastavení GitHub Actions secrets. Produkční databáze a `.env.production` zůstávají mimo Git.

## Šablona

Aktivovaná šablona: `real-estate-property` z WordPress.org.

Stažený instalační ZIP je lokálně v `storage/theme-packages/` a není součástí repozitáře.
