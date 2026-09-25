<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class UpdateMessagesTable extends Migration
{
    public function up()
    {
        $this->forge->addColumn('messages', [
            'parent_id'   => ['type' => 'INT', 'constraint' => 11, 'unsigned' => true, 'null' => true, 'after' => 'id'],
            'sender_type' => ['type' => 'ENUM', 'constraint' => ['visitor', 'admin'], 'default' => 'visitor', 'after' => 'is_read'],
        ]);
    }
    public function down()
    {
        $this->forge->dropColumn('messages', 'parent_id');
        $this->forge->dropColumn('messages', 'sender_type');
    }
}
