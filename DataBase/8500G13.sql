
-- 创建模式
CREATE SCHEMA "8500_HKMU_G13";

-- 创建权限 ENUM 类型
CREATE TYPE user_permission AS ENUM ('Read', 'Scrap', 'Purchase', 'Sale', 'Return', 'User Management');

CREATE EXTENSION IF NOT EXISTS pgcrypto;

--  定义枚举类型
CREATE TYPE transaction_type AS ENUM ('sale', 'return', 'purchase', 'scrap');

-- 1. `roles` 表
CREATE TABLE "8500_HKMU_G13".roles (
    role_id SERIAL PRIMARY KEY,
    role_name VARCHAR(50) NOT NULL
);

-- 2. `staff` 表
CREATE TABLE "8500_HKMU_G13".staff (
    staff_id SERIAL PRIMARY KEY,
    staff_name VARCHAR(100) NOT NULL,
    role_id INT,
    FOREIGN KEY (role_id) REFERENCES "8500_HKMU_G13".roles(role_id)
);

-- 3. `furniture` 表
CREATE TABLE "8500_HKMU_G13".furniture (
    furniture_id SERIAL PRIMARY KEY,
    furniture_name VARCHAR(100) NOT NULL,
    furniture_category VARCHAR(50) NOT NULL,
    furniture_material VARCHAR(50) NOT NULL,
    furniture_color VARCHAR(30),
    furniture_dimensions VARCHAR(50),
    furniture_weight FLOAT,
    furniture_price DECIMAL(10, 2) NOT NULL,
    furniture_manufacturer VARCHAR(100),
    stock_quantity INT NOT NULL,
    furniture_description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- 5. `inventory_transactions` 表
CREATE TABLE "8500_HKMU_G13".inventory_transactions (
    transaction_id SERIAL PRIMARY KEY,
    furniture_id INT,
    staff_id INT,
    transaction_type transaction_type NOT NULL,
    quantity INT NOT NULL,
    transaction_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (furniture_id) REFERENCES "8500_HKMU_G13".furniture(furniture_id),
    FOREIGN KEY (staff_id) REFERENCES "8500_HKMU_G13".staff(staff_id)
);

--6. 创建用户表
CREATE TABLE "8500_HKMU_G13".users (
    user_id SERIAL PRIMARY KEY,
    username VARCHAR(50) UNIQUE NOT NULL,
    user_type VARCHAR(20) NOT NULL,
    user_permissions user_permission[] NOT NULL,  -- 使用数组来存储多个权限
    password VARCHAR(255)  -- 可选：存储加密密码
);

-- 插入用户记录
INSERT INTO "8500_HKMU_G13".users (username, user_type, user_permissions, password)
VALUES (
    'testAdmin',
    'Super User',
    ARRAY['Read'::user_permission,'User Management'::user_permission],  -- 多个权限
    'AdminTest'  -- 用实际哈希密码替换
);

UPDATE "8500_HKMU_G13".users
SET 
    user_type = 'Super User',
    user_permissions = ARRAY['Read'::user_permission, 'User Management'::user_permission],  -- 多个权限
    password = crypt('AdminTest', gen_salt('bf')) -- 用实际哈希密码替换
WHERE 
    username = 'testAdmin';

select * from user
