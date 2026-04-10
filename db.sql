-- PostgreSQL syntax
-- Create Database
CREATE DATABASE user_management;

-- Create Schema
CREATE SCHEMA ums;

-- Create Table 
CREATE TABLE ums.users (
    id SERIAL PRIMARY KEY,
    name VARCHAR(100),
    email VARCHAR(150) UNIQUE NOT NULL,
    password TEXT NOT NULL,
    role VARCHAR(20) DEFAULT 'user',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Modify Table
ALTER TABLE ums.users ADD COLUMN status VARCHAR(10) DEFAULT 'active';
ALTER TABLE ums.users ADD COLUMN actions VARCHAR(10) DEFAULT 'created';
