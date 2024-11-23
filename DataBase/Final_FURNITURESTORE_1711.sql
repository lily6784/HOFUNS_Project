-- 删除已有的枚举类型（如果存在）
DO $$ 
BEGIN
    IF EXISTS (SELECT 1 FROM pg_type WHERE typname = 'role_enum') THEN
        DROP TYPE role_enum;
    END IF;
END $$;

-- 创建架构
CREATE SCHEMA IF NOT EXISTS "8500_HKMU_G13";

-- 创建枚举类型
CREATE TYPE role_enum AS ENUM ('admin', 'keeper', 'saler');

-- 创建 USERS 表
CREATE TABLE IF NOT EXISTS "8500_HKMU_G13"."USERS" (
    ID serial PRIMARY KEY,
    username varchar NOT NULL UNIQUE,
    password varchar NOT NULL,
    Name varchar NOT NULL,
    Role role_enum NOT NULL,
    status_inactive boolean NOT NULL
);

-- 创建 INVENTORY 表
CREATE TABLE IF NOT EXISTS "8500_HKMU_G13"."INVENTORY" (
    item_id serial PRIMARY KEY,
    item_name varchar NOT NULL,
    status_scrapped boolean NOT NULL,
    status_sold boolean NOT NULL,
    status_returned boolean NOT NULL
);

INSERT INTO "8500_HKMU_G13"."USERS" (role, name, password, username)
VALUES ('admin', 'Brian', crypt('AdminTest', gen_salt('bf')), 'admin1');