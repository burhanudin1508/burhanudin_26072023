/*
 Navicat Premium Data Transfer

 Source Server         : localhost_5432
 Source Server Type    : PostgreSQL
 Source Server Version : 90620 (90620)
 Source Host           : localhost:5432
 Source Catalog        : best
 Source Schema         : public

 Target Server Type    : PostgreSQL
 Target Server Version : 90620 (90620)
 File Encoding         : 65001

 Date: 26/07/2023 14:16:01
*/


-- ----------------------------
-- Sequence structure for hobi_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."hobi_id_seq";
CREATE SEQUENCE "public"."hobi_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for pegawain_pegawai_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."pegawain_pegawai_id_seq";
CREATE SEQUENCE "public"."pegawain_pegawai_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for user_hobi_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."user_hobi_id_seq";
CREATE SEQUENCE "public"."user_hobi_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for user_user_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."user_user_id_seq";
CREATE SEQUENCE "public"."user_user_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Table structure for hobi
-- ----------------------------
DROP TABLE IF EXISTS "public"."hobi";
CREATE TABLE "public"."hobi" (
  "id" int4 NOT NULL DEFAULT nextval('hobi_id_seq'::regclass),
  "hobi" varchar(255) COLLATE "pg_catalog"."default"
)
;

-- ----------------------------
-- Records of hobi
-- ----------------------------

-- ----------------------------
-- Table structure for pegawai
-- ----------------------------
DROP TABLE IF EXISTS "public"."pegawai";
CREATE TABLE "public"."pegawai" (
  "pegawai_id" int2 NOT NULL DEFAULT nextval('pegawain_pegawai_id_seq'::regclass),
  "pegawai_nama" varchar(50) COLLATE "pg_catalog"."default",
  "pegawai_jabatan" varchar(20) COLLATE "pg_catalog"."default",
  "pegawai_umur" int4,
  "pegawai_alamat" varchar(255) COLLATE "pg_catalog"."default"
)
;

-- ----------------------------
-- Records of pegawai
-- ----------------------------

-- ----------------------------
-- Table structure for user_hobi
-- ----------------------------
DROP TABLE IF EXISTS "public"."user_hobi";
CREATE TABLE "public"."user_hobi" (
  "id" int2 NOT NULL DEFAULT nextval('user_hobi_id_seq'::regclass),
  "hobi_id" int4,
  "user_id" int4
)
;

-- ----------------------------
-- Records of user_hobi
-- ----------------------------

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS "public"."users";
CREATE TABLE "public"."users" (
  "user_id" int8 NOT NULL DEFAULT nextval('user_user_id_seq'::regclass),
  "nama_lengkap" varchar(255) COLLATE "pg_catalog"."default",
  "tempat_lahir" varchar(255) COLLATE "pg_catalog"."default",
  "tanggal_lahir" date,
  "alamat" varchar(255) COLLATE "pg_catalog"."default",
  "no_hp" varchar(22) COLLATE "pg_catalog"."default",
  "jenis_kelamin" int2,
  "agama" int2,
  "status" int2 DEFAULT 0,
  "email" varchar(255) COLLATE "pg_catalog"."default",
  "password" varchar(255) COLLATE "pg_catalog"."default"
)
;
COMMENT ON COLUMN "public"."users"."jenis_kelamin" IS '1:Pria;2:wanita';
COMMENT ON COLUMN "public"."users"."agama" IS '1:islam
2: kristen protestan
3: katolik
4: budha
5. hindu';
COMMENT ON COLUMN "public"."users"."status" IS '1: active; 0:inactive';

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO "public"."users" VALUES (1, 'admin', 'bandun', '2023-07-26', 'test', '098217391729', 1, 1, 1, 'admin@gmail.com', '$2y$10$AumcgNiCQgwh4LlHEllyP.cy1e/Z2QphEO4qGsy.WkR5QsDT9J4WG');

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."hobi_id_seq"
OWNED BY "public"."hobi"."id";
SELECT setval('"public"."hobi_id_seq"', 1, false);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."pegawain_pegawai_id_seq"
OWNED BY "public"."pegawai"."pegawai_id";
SELECT setval('"public"."pegawain_pegawai_id_seq"', 1, false);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."user_hobi_id_seq"
OWNED BY "public"."user_hobi"."id";
SELECT setval('"public"."user_hobi_id_seq"', 1, false);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."user_user_id_seq"
OWNED BY "public"."users"."user_id";
SELECT setval('"public"."user_user_id_seq"', 1, true);

-- ----------------------------
-- Primary Key structure for table hobi
-- ----------------------------
ALTER TABLE "public"."hobi" ADD CONSTRAINT "hobi_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table pegawai
-- ----------------------------
ALTER TABLE "public"."pegawai" ADD CONSTRAINT "pegawain_pkey" PRIMARY KEY ("pegawai_id");

-- ----------------------------
-- Primary Key structure for table user_hobi
-- ----------------------------
ALTER TABLE "public"."user_hobi" ADD CONSTRAINT "user_hobi_pkey" PRIMARY KEY ("id");

-- ----------------------------
-- Primary Key structure for table users
-- ----------------------------
ALTER TABLE "public"."users" ADD CONSTRAINT "user_pkey" PRIMARY KEY ("user_id");
