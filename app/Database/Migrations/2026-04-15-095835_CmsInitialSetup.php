<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CmsInitialSetup extends Migration
{
    public function up()
    {
        // 1. SETTINGS TABLE
        $this->forge->addField([
            'id'            => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'setting_key'   => ['type' => 'VARCHAR', 'constraint' => 100],
            'setting_value' => ['type' => 'TEXT', 'null' => true],
            'setting_type'  => ['type' => 'ENUM', 'constraint' => ['text', 'textarea', 'image', 'url'], 'default' => 'text'],
            'description'   => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('setting_key');
        $this->forge->createTable('settings');

        // 2. USERS TABLE
        $this->forge->addField([
            'id'         => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'name'       => ['type' => 'VARCHAR', 'constraint' => 100],
            'username'   => ['type' => 'VARCHAR', 'constraint' => 50],
            'email'      => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'password'   => ['type' => 'VARCHAR', 'constraint' => 255],
            'role'       => ['type' => 'ENUM', 'constraint' => ['superadmin', 'admin', 'author'], 'default' => 'admin'],
            'status'     => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 1],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('username');
        $this->forge->addUniqueKey('email');
        $this->forge->createTable('users');

        // 3. PAGES TABLE
        $this->forge->addField([
            'id'               => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'title'            => ['type' => 'VARCHAR', 'constraint' => 255],
            'slug'             => ['type' => 'VARCHAR', 'constraint' => 255],
            'content'          => ['type' => 'LONGTEXT', 'null' => true],
            'featured_image'   => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'meta_title'       => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'meta_description' => ['type' => 'TEXT', 'null' => true],
            'status'           => ['type' => 'ENUM', 'constraint' => ['published', 'draft'], 'default' => 'draft'],
            'created_at'       => ['type' => 'DATETIME', 'null' => true],
            'updated_at'       => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('slug');
        $this->forge->createTable('pages');

        // 4. CATEGORIES TABLE
        $this->forge->addField([
            'id'   => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'name' => ['type' => 'VARCHAR', 'constraint' => 100],
            'slug' => ['type' => 'VARCHAR', 'constraint' => 100],
            'type' => ['type' => 'ENUM', 'constraint' => ['post', 'portfolio', 'service'], 'default' => 'post'],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('slug');
        $this->forge->createTable('categories');

        // 5. POSTS TABLE
        $this->forge->addField([
            'id'             => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'user_id'        => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'category_id'    => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'title'          => ['type' => 'VARCHAR', 'constraint' => 255],
            'slug'           => ['type' => 'VARCHAR', 'constraint' => 255],
            'content'        => ['type' => 'LONGTEXT'],
            'featured_image' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'status'         => ['type' => 'ENUM', 'constraint' => ['published', 'draft'], 'default' => 'draft'],
            'created_at'     => ['type' => 'DATETIME', 'null' => true],
            'updated_at'     => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('slug');
        $this->forge->addForeignKey('user_id', 'users', 'id', 'CASCADE', 'CASCADE');
        $this->forge->addForeignKey('category_id', 'categories', 'id', 'SET NULL', 'CASCADE');
        $this->forge->createTable('posts');

        // 6. PORTFOLIOS TABLE
        $this->forge->addField([
            'id'            => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'category_id'   => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true],
            'title'         => ['type' => 'VARCHAR', 'constraint' => 255],
            'slug'          => ['type' => 'VARCHAR', 'constraint' => 255],
            'client_name'   => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'project_url'   => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'description'   => ['type' => 'LONGTEXT', 'null' => true],
            'cover_image'   => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'project_date'  => ['type' => 'DATE', 'null' => true],
            'status'        => ['type' => 'ENUM', 'constraint' => ['published', 'draft'], 'default' => 'draft'],
            'created_at'    => ['type' => 'DATETIME', 'null' => true],
            'updated_at'    => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('slug');
        $this->forge->addForeignKey('category_id', 'categories', 'id', 'SET NULL', 'CASCADE');
        $this->forge->createTable('portfolios');

        // 7. MEDIA GALLERY TABLE
        $this->forge->addField([
            'id'            => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'relation_id'   => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true],
            'relation_type' => ['type' => 'ENUM', 'constraint' => ['portfolio', 'page', 'post']],
            'file_name'     => ['type' => 'VARCHAR', 'constraint' => 255],
            'file_path'     => ['type' => 'VARCHAR', 'constraint' => 255],
            'sort_order'    => ['type' => 'INT', 'constraint' => 11, 'default' => 0],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('media_gallery');

        // 8. SERVICES TABLE
        $this->forge->addField([
            'id'                => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'title'             => ['type' => 'VARCHAR', 'constraint' => 255],
            'slug'              => ['type' => 'VARCHAR', 'constraint' => 255],
            'short_description' => ['type' => 'TEXT', 'null' => true],
            'content'           => ['type' => 'LONGTEXT', 'null' => true],
            'icon_class'        => ['type' => 'VARCHAR', 'constraint' => 100, 'null' => true],
            'image'             => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'status'            => ['type' => 'ENUM', 'constraint' => ['published', 'draft'], 'default' => 'draft'],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('slug');
        $this->forge->createTable('services');

        // 9. TEAMS TABLE
        $this->forge->addField([
            'id'           => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'name'         => ['type' => 'VARCHAR', 'constraint' => 255],
            'position'     => ['type' => 'VARCHAR', 'constraint' => 255],
            'bio'          => ['type' => 'TEXT', 'null' => true],
            'image'        => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'social_links' => ['type' => 'JSON', 'null' => true],
            'sort_order'   => ['type' => 'INT', 'constraint' => 11, 'default' => 0],
            'status'       => ['type' => 'ENUM', 'constraint' => ['published', 'draft'], 'default' => 'draft'],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('teams');

        // 10. MESSAGES TABLE
        $this->forge->addField([
            'id'         => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'name'       => ['type' => 'VARCHAR', 'constraint' => 100],
            'email'      => ['type' => 'VARCHAR', 'constraint' => 100],
            'subject'    => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'message'    => ['type' => 'TEXT'],
            'is_read'    => ['type' => 'TINYINT', 'constraint' => 1, 'default' => 0],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('messages');
    }

    public function down()
    {
        // Drop tabel dengan urutan terbalik untuk menghindari error foreign key
        $this->forge->dropTable('messages', true);
        $this->forge->dropTable('teams', true);
        $this->forge->dropTable('services', true);
        $this->forge->dropTable('media_gallery', true);
        $this->forge->dropTable('portfolios', true);
        $this->forge->dropTable('posts', true);
        $this->forge->dropTable('categories', true);
        $this->forge->dropTable('pages', true);
        $this->forge->dropTable('users', true);
        $this->forge->dropTable('settings', true);
    }
}
