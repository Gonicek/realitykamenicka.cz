# Deployment realitykamenicka.cz

Produkční stack odpovídá ostatním serverovým aplikacím na `krkstrc.cz`:

```text
GitHub main
  → GitHub Actions
  → SSH/SCP na server
  → /home/<server-user>/apps/realitykamenicka.cz
  → Docker Compose (MariaDB + WordPress)
  → shared Docker network `web`
  → caddy-proxy
  → https://realitykamenicka.krkstrc.cz
```

## Jednorázová příprava serveru

Na serveru musí být připravené:

1. Docker a Docker Compose plugin.
2. Externí síť `web`:

   ```bash
   docker network create web 2>/dev/null || true
   ```

3. Caddy připojený k síti `web` a konfigurace z `deploy/Caddyfile.example`.
4. Soubor `.env.production` s produkčními hesly.
5. SSH účet s právem zapisovat do deploy cesty a spouštět Docker.

Pokud na serveru už běží původní WordPress, nejdříve je nutné udělat databázový a souborový backup. Tento workflow původní databázi nemaže.

## GitHub Actions secrets

Repozitář očekává tyto secrets:

| Secret | Význam |
|---|---|
| `SERVER_HOST` | SSH hostname, např. `krkstrc.cz` |
| `SERVER_PORT` | SSH port, obvykle `22` |
| `SERVER_USER` | SSH uživatel, např. `kamenicka` |
| `SERVER_SSH_KEY` | Privátní SSH klíč pro deploy |
| `REALITYKAMENICKA_DEPLOY_PATH` | Např. `/home/kamenicka/apps/realitykamenicka.cz` |

Produkční `.env.production` se do GitHubu neposílá. Vkládá se na server při jednorázové přípravě.

## Automatický deploy

Push do `main` provede:

1. CI validaci Compose a PHP syntaxe.
2. Read-only zálohu existující deploy složky na serveru.
3. Synchronizaci verzovaných WordPress souborů a Compose konfigurace.
4. `docker compose -f compose.prod.yml up -d --remove-orphans`.
5. Reload Caddy.
6. HTTPS smoke test.

`wp-content/uploads`, cache a `wp-config.php` nejsou verzované. Uploady jsou v produkci uchovávané v Docker volume a workflow je nepřepisuje.

## Ruční ověření na serveru

```bash
cd /home/<server-user>/apps/realitykamenicka.cz
docker compose --env-file .env.production -f compose.prod.yml ps
curl -I https://realitykamenicka.krkstrc.cz/
```
