<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateClientsTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id'         => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'name'       => ['type' => 'VARCHAR', 'constraint' => 255],
            'logo'       => ['type' => 'VARCHAR', 'constraint' => 255],
            'sort_order' => ['type' => 'INT', 'constraint' => 11, 'default' => 0],
            'status'     => ['type' => 'ENUM', 'constraint' => ['published', 'draft'], 'default' => 'published'],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('clients');
    }
    public function down()
    {
        $this->forge->dropTable('clients');
    }
}
