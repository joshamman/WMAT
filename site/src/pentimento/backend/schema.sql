-- Pentimento Phase A — one key/value table in the existing (legacy WordPress) MySQL DB.
-- The app already stores everything under string keys (pentimento-index and
-- pentimento-session-<id>), so a generic KV table is all the server needs. Run once:
--   mysql -u YOUR_USER -p YOUR_WP_DB < schema.sql

CREATE TABLE IF NOT EXISTS pentimento_kv (
  k          VARCHAR(191) NOT NULL PRIMARY KEY,   -- e.g. 'pentimento-session-<id>'
  v          LONGTEXT     NOT NULL,               -- the JSON value, verbatim
  updated_at TIMESTAMP    NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
