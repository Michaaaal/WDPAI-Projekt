/*
 Navicat Premium Data Transfer

 Source Server         : wdpai-db
 Source Server Type    : PostgreSQL
 Source Server Version : 160001 (160001)
 Source Host           : localhost:5432
 Source Catalog        : postgres
 Source Schema         : public

 Target Server Type    : PostgreSQL
 Target Server Version : 160001 (160001)
 File Encoding         : 65001

 Date: 17/01/2024 07:14:09
*/


-- ----------------------------
-- Type structure for user_type
-- ----------------------------
DROP TYPE IF EXISTS "public"."user_type";
CREATE TYPE "public"."user_type" AS ENUM (
  'standard',
  'premium',
  'admin'
);
ALTER TYPE "public"."user_type" OWNER TO "postgres";

-- ----------------------------
-- Sequence structure for competition_images_id_competition_image_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."competition_images_id_competition_image_seq";
CREATE SEQUENCE "public"."competition_images_id_competition_image_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for competition_images_topic_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."competition_images_topic_id_seq";
CREATE SEQUENCE "public"."competition_images_topic_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for competition_images_user_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."competition_images_user_id_seq";
CREATE SEQUENCE "public"."competition_images_user_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for country_id_country_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."country_id_country_seq";
CREATE SEQUENCE "public"."country_id_country_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for evaluated_competition_image_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."evaluated_competition_image_id_seq";
CREATE SEQUENCE "public"."evaluated_competition_image_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for evaluated_evaluated_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."evaluated_evaluated_id_seq";
CREATE SEQUENCE "public"."evaluated_evaluated_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for evaluated_user_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."evaluated_user_id_seq";
CREATE SEQUENCE "public"."evaluated_user_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for topics_id_topic_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."topics_id_topic_seq";
CREATE SEQUENCE "public"."topics_id_topic_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for user_types_id_user_types_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."user_types_id_user_types_seq";
CREATE SEQUENCE "public"."user_types_id_user_types_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for users_country_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."users_country_id_seq";
CREATE SEQUENCE "public"."users_country_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for users_id_user_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."users_id_user_seq";
CREATE SEQUENCE "public"."users_id_user_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for users_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."users_seq";
CREATE SEQUENCE "public"."users_seq" 
INCREMENT 50
MINVALUE  1
MAXVALUE 9223372036854775807
START 1
CACHE 1;

-- ----------------------------
-- Sequence structure for users_user_type_id_seq
-- ----------------------------
DROP SEQUENCE IF EXISTS "public"."users_user_type_id_seq";
CREATE SEQUENCE "public"."users_user_type_id_seq" 
INCREMENT 1
MINVALUE  1
MAXVALUE 2147483647
START 1
CACHE 1;

-- ----------------------------
-- Table structure for competition_images
-- ----------------------------
DROP TABLE IF EXISTS "public"."competition_images";
CREATE TABLE "public"."competition_images" (
  "id_competition_image" int8 NOT NULL DEFAULT nextval('competition_images_id_competition_image_seq'::regclass),
  "topic_id" int4 NOT NULL DEFAULT nextval('competition_images_topic_id_seq'::regclass),
  "user_id" int8 NOT NULL DEFAULT nextval('competition_images_user_id_seq'::regclass),
  "likes" int4 NOT NULL DEFAULT 0,
  "unlikes" int4 NOT NULL DEFAULT 0,
  "description" text COLLATE "pg_catalog"."default",
  "place" int4,
  "img" varchar(255) COLLATE "pg_catalog"."default"
)
;

-- ----------------------------
-- Records of competition_images
-- ----------------------------
INSERT INTO "public"."competition_images" VALUES (22, 2, 11, 1, 0, 'bestia666   (mountains): gora1', NULL, 'gal5.jpg');
INSERT INTO "public"."competition_images" VALUES (23, 2, 11, 1, 0, 'bestia666   (mountains): gora2', NULL, 'gal4.jpg');
INSERT INTO "public"."competition_images" VALUES (21, 1, 11, 4, 0, 'bestia666   (christmas): drzewko 5', NULL, 'swieta2.jpg');
INSERT INTO "public"."competition_images" VALUES (17, 1, 11, 2, 3, 'bestia666   (christmas): drzewko', NULL, '231213154218-rockerfeller-treee-112923.jpg');
INSERT INTO "public"."competition_images" VALUES (24, 1, 12, 1, 0, 'KOXMARIUSZ   (Christmas): uyttyug', NULL, 'Beach-Sunset-Depositphotos_93376090_original-copy.jpg');
INSERT INTO "public"."competition_images" VALUES (18, 1, 11, 3, 2, 'bestia666   (christmas): drzewko 2', NULL, 'christmas-tree-1024x538.jpg');
INSERT INTO "public"."competition_images" VALUES (19, 1, 11, 4, 1, 'bestia666   (christmas): drzewko 3', NULL, 'christmas-trees-gettyimages-1072744106.jpg');
INSERT INTO "public"."competition_images" VALUES (20, 1, 11, 1, 4, 'bestia666   (christmas): drzewko 4', NULL, 'Lighting-National-Christmas-Tree-Washington-DC-2008.jpg');
INSERT INTO "public"."competition_images" VALUES (26, 6, 11, 0, 0, 'bestia666   (Dogs): ', NULL, '891a8ba23745e53092b6e747efa7f49c.jpg');
INSERT INTO "public"."competition_images" VALUES (27, 6, 11, 0, 0, 'bestia666   (Dogs): azorek', NULL, 'brzydkipies02.jpg');
INSERT INTO "public"."competition_images" VALUES (28, 6, 11, 0, 0, 'bestia666   (Dogs): reksio', NULL, 'shutterstock-8050477.jpeg');

-- ----------------------------
-- Table structure for country
-- ----------------------------
DROP TABLE IF EXISTS "public"."country";
CREATE TABLE "public"."country" (
  "id_country" int4 NOT NULL DEFAULT nextval('country_id_country_seq'::regclass),
  "iso" varchar(2) COLLATE "pg_catalog"."default" NOT NULL,
  "phonecode" int4 NOT NULL,
  "name" varchar(50) COLLATE "pg_catalog"."default" NOT NULL
)
;

-- ----------------------------
-- Records of country
-- ----------------------------
INSERT INTO "public"."country" VALUES (171, 'PL', 43, 'Poland');

-- ----------------------------
-- Table structure for evaluated
-- ----------------------------
DROP TABLE IF EXISTS "public"."evaluated";
CREATE TABLE "public"."evaluated" (
  "evaluated_id" int8 NOT NULL DEFAULT nextval('evaluated_evaluated_id_seq'::regclass),
  "id_user" int4 NOT NULL DEFAULT nextval('evaluated_user_id_seq'::regclass),
  "id_competition_image" int4 NOT NULL DEFAULT nextval('evaluated_competition_image_id_seq'::regclass)
)
;

-- ----------------------------
-- Records of evaluated
-- ----------------------------

-- ----------------------------
-- Table structure for gallery_images
-- ----------------------------
DROP TABLE IF EXISTS "public"."gallery_images";
CREATE TABLE "public"."gallery_images" (
  "id_gallery_images" int4 NOT NULL,
  "id_user" int4,
  "slot1" bytea,
  "slot2" bytea,
  "slot3" bytea,
  "slot4" bytea,
  "slot5" bytea,
  "slot6" bytea
)
;

-- ----------------------------
-- Records of gallery_images
-- ----------------------------
INSERT INTO "public"."gallery_images" VALUES (1, 12, NULL, NULL, NULL, NULL, NULL, NULL);

-- ----------------------------
-- Table structure for topics
-- ----------------------------
DROP TABLE IF EXISTS "public"."topics";
CREATE TABLE "public"."topics" (
  "id_topic" int4 NOT NULL DEFAULT nextval('topics_id_topic_seq'::regclass),
  "topic" varchar(50) COLLATE "pg_catalog"."default" NOT NULL,
  "start_date" timestamp(6),
  "end_date" timestamp(6),
  "actual" bool NOT NULL
)
;

-- ----------------------------
-- Records of topics
-- ----------------------------
INSERT INTO "public"."topics" VALUES (5, 'Towns', '2024-05-14 00:00:00', '2024-06-14 00:00:00', 'f');
INSERT INTO "public"."topics" VALUES (3, 'Architecture', '2024-03-12 00:00:00', '2024-04-12 00:00:00', 'f');
INSERT INTO "public"."topics" VALUES (4, 'Lake', '2024-04-13 00:00:00', '2024-05-13 00:00:00', 'f');
INSERT INTO "public"."topics" VALUES (2, 'Mountains', '2024-02-11 00:00:00', '2024-03-11 00:00:00', 'f');
INSERT INTO "public"."topics" VALUES (6, 'Dogs', '2024-06-15 00:00:00', '2024-07-15 00:00:00', 'f');
INSERT INTO "public"."topics" VALUES (1, 'Christmas', '2024-01-10 00:00:00', '2024-02-10 00:00:00', 't');

-- ----------------------------
-- Table structure for user_types
-- ----------------------------
DROP TABLE IF EXISTS "public"."user_types";
CREATE TABLE "public"."user_types" (
  "id_user_types" int4 NOT NULL DEFAULT nextval('user_types_id_user_types_seq'::regclass),
  "type" "public"."user_type" NOT NULL DEFAULT 'standard'::user_type
)
;

-- ----------------------------
-- Records of user_types
-- ----------------------------
INSERT INTO "public"."user_types" VALUES (1, 'standard');
INSERT INTO "public"."user_types" VALUES (2, 'premium');
INSERT INTO "public"."user_types" VALUES (3, 'admin');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS "public"."users";
CREATE TABLE "public"."users" (
  "id_user" int8 NOT NULL DEFAULT nextval('users_id_user_seq'::regclass),
  "user_type_id" int4 NOT NULL DEFAULT nextval('users_user_type_id_seq'::regclass),
  "country_id" int4 NOT NULL DEFAULT nextval('users_country_id_seq'::regclass),
  "email" varchar(60) COLLATE "pg_catalog"."default" NOT NULL,
  "phone_number" varchar(15) COLLATE "pg_catalog"."default",
  "nickname" varchar(30) COLLATE "pg_catalog"."default",
  "password_hash" varchar(128) COLLATE "pg_catalog"."default"
)
;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO "public"."users" VALUES (11, 1, 171, 'wojtyla@op.pl', '213702137', 'bestia666', '$2y$10$j3d/1VjHy3k/2RjMREBq6.gdW5jlxONgfwzQkq9udhNQJt//hHZBe');
INSERT INTO "public"."users" VALUES (12, 1, 171, 'pudzian@kox.pl', '999999999', 'KOXMARIUSZ', '$2y$10$8KhZZPayK6rgy9Sw3sA/4ue.zQCWOeYdfjC5oVHI.lYnBIbLtPy1G');
INSERT INTO "public"."users" VALUES (13, 3, 171, 'admin@adas.pl', '123123123', 'adasadmin', '$2y$10$ljcQuXZ3yFFCf3LrOaa9ouRFsCwGjexzL5rRYDmtyljOs/QQTvbPG');

-- ----------------------------
-- Function structure for set_actual_false
-- ----------------------------
DROP FUNCTION IF EXISTS "public"."set_actual_false"();
CREATE OR REPLACE FUNCTION "public"."set_actual_false"()
  RETURNS "pg_catalog"."trigger" AS $BODY$
BEGIN
    IF NEW.actual = TRUE THEN
        UPDATE topics SET actual = FALSE WHERE actual = TRUE;
    END IF;
    RETURN NEW;
END;
$BODY$
  LANGUAGE plpgsql VOLATILE
  COST 100;

-- ----------------------------
-- View structure for not_evaluated_competition_images_per_user
-- ----------------------------
DROP VIEW IF EXISTS "public"."not_evaluated_competition_images_per_user";
CREATE VIEW "public"."not_evaluated_competition_images_per_user" AS  SELECT users.id_user,
    users.user_type_id,
    users.country_id,
    users.email,
    users.phone_number,
    users.nickname,
    users.password_hash,
    ci.id_competition_image,
    ci.topic_id,
    ci.user_id,
    ci.likes,
    ci.unlikes,
    ci.description,
    ci.place,
    ci.img
   FROM competition_images ci
     JOIN users ON users.id_user = ci.user_id
  WHERE NOT (ci.id_competition_image IN ( SELECT evaluated.id_competition_image
           FROM evaluated
          WHERE evaluated.id_user = ci.user_id))
  ORDER BY users.id_user;

-- ----------------------------
-- View structure for competition_images_from_actual_topic
-- ----------------------------
DROP VIEW IF EXISTS "public"."competition_images_from_actual_topic";
CREATE VIEW "public"."competition_images_from_actual_topic" AS  SELECT topics.topic,
    ci.description,
    ci.topic_id,
    ci.likes,
    ci.unlikes
   FROM competition_images ci
     RIGHT JOIN topics ON topics.id_topic = ci.topic_id
  WHERE topics.actual = true
  ORDER BY ci.likes DESC, ci.unlikes;

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."competition_images_id_competition_image_seq"
OWNED BY "public"."competition_images"."id_competition_image";
SELECT setval('"public"."competition_images_id_competition_image_seq"', 28, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."competition_images_topic_id_seq"
OWNED BY "public"."competition_images"."topic_id";
SELECT setval('"public"."competition_images_topic_id_seq"', 1, false);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."competition_images_user_id_seq"
OWNED BY "public"."competition_images"."user_id";
SELECT setval('"public"."competition_images_user_id_seq"', 1, false);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."country_id_country_seq"
OWNED BY "public"."country"."id_country";
SELECT setval('"public"."country_id_country_seq"', 1, false);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."evaluated_competition_image_id_seq"
OWNED BY "public"."evaluated"."id_competition_image";
SELECT setval('"public"."evaluated_competition_image_id_seq"', 1, false);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."evaluated_evaluated_id_seq"
OWNED BY "public"."evaluated"."evaluated_id";
SELECT setval('"public"."evaluated_evaluated_id_seq"', 29, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."evaluated_user_id_seq"
OWNED BY "public"."evaluated"."id_user";
SELECT setval('"public"."evaluated_user_id_seq"', 1, false);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."topics_id_topic_seq"
OWNED BY "public"."topics"."id_topic";
SELECT setval('"public"."topics_id_topic_seq"', 6, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."user_types_id_user_types_seq"
OWNED BY "public"."user_types"."id_user_types";
SELECT setval('"public"."user_types_id_user_types_seq"', 3, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."users_country_id_seq"
OWNED BY "public"."users"."country_id";
SELECT setval('"public"."users_country_id_seq"', 1, false);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."users_id_user_seq"
OWNED BY "public"."users"."id_user";
SELECT setval('"public"."users_id_user_seq"', 15, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
SELECT setval('"public"."users_seq"', 1, true);

-- ----------------------------
-- Alter sequences owned by
-- ----------------------------
ALTER SEQUENCE "public"."users_user_type_id_seq"
OWNED BY "public"."users"."user_type_id";
SELECT setval('"public"."users_user_type_id_seq"', 1, false);

-- ----------------------------
-- Primary Key structure for table competition_images
-- ----------------------------
ALTER TABLE "public"."competition_images" ADD CONSTRAINT "competition_images_pkey" PRIMARY KEY ("id_competition_image");

-- ----------------------------
-- Uniques structure for table country
-- ----------------------------
ALTER TABLE "public"."country" ADD CONSTRAINT "country_name_key" UNIQUE ("iso");

-- ----------------------------
-- Primary Key structure for table country
-- ----------------------------
ALTER TABLE "public"."country" ADD CONSTRAINT "country_pkey" PRIMARY KEY ("id_country");

-- ----------------------------
-- Primary Key structure for table evaluated
-- ----------------------------
ALTER TABLE "public"."evaluated" ADD CONSTRAINT "evaluated_pkey" PRIMARY KEY ("evaluated_id");

-- ----------------------------
-- Primary Key structure for table gallery_images
-- ----------------------------
ALTER TABLE "public"."gallery_images" ADD CONSTRAINT "gallery_images_pkey" PRIMARY KEY ("id_gallery_images");

-- ----------------------------
-- Triggers structure for table topics
-- ----------------------------
CREATE TRIGGER "trigger_set_actual_false" BEFORE INSERT ON "public"."topics"
FOR EACH ROW
EXECUTE PROCEDURE "public"."set_actual_false"();

-- ----------------------------
-- Primary Key structure for table topics
-- ----------------------------
ALTER TABLE "public"."topics" ADD CONSTRAINT "topics_pkey" PRIMARY KEY ("id_topic");

-- ----------------------------
-- Primary Key structure for table user_types
-- ----------------------------
ALTER TABLE "public"."user_types" ADD CONSTRAINT "user_types_pkey" PRIMARY KEY ("id_user_types");

-- ----------------------------
-- Primary Key structure for table users
-- ----------------------------
ALTER TABLE "public"."users" ADD CONSTRAINT "users_pkey" PRIMARY KEY ("id_user");

-- ----------------------------
-- Foreign Keys structure for table competition_images
-- ----------------------------
ALTER TABLE "public"."competition_images" ADD CONSTRAINT "competition_images_fk0" FOREIGN KEY ("topic_id") REFERENCES "public"."topics" ("id_topic") ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE "public"."competition_images" ADD CONSTRAINT "competition_images_fk1" FOREIGN KEY ("user_id") REFERENCES "public"."users" ("id_user") ON DELETE CASCADE ON UPDATE CASCADE;

-- ----------------------------
-- Foreign Keys structure for table evaluated
-- ----------------------------
ALTER TABLE "public"."evaluated" ADD CONSTRAINT "competition_image_fk" FOREIGN KEY ("id_competition_image") REFERENCES "public"."competition_images" ("id_competition_image") ON DELETE CASCADE ON UPDATE CASCADE;
ALTER TABLE "public"."evaluated" ADD CONSTRAINT "user_fk" FOREIGN KEY ("id_user") REFERENCES "public"."users" ("id_user") ON DELETE CASCADE ON UPDATE CASCADE;

-- ----------------------------
-- Foreign Keys structure for table gallery_images
-- ----------------------------
ALTER TABLE "public"."gallery_images" ADD CONSTRAINT "user_fk" FOREIGN KEY ("id_user") REFERENCES "public"."users" ("id_user") ON DELETE CASCADE ON UPDATE CASCADE;

-- ----------------------------
-- Foreign Keys structure for table users
-- ----------------------------
ALTER TABLE "public"."users" ADD CONSTRAINT "users_fk0" FOREIGN KEY ("user_type_id") REFERENCES "public"."user_types" ("id_user_types") ON DELETE NO ACTION ON UPDATE NO ACTION;
ALTER TABLE "public"."users" ADD CONSTRAINT "users_fk2" FOREIGN KEY ("country_id") REFERENCES "public"."country" ("id_country") ON DELETE NO ACTION ON UPDATE NO ACTION;
