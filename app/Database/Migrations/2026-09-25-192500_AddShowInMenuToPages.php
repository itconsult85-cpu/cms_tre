<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddShowInMenuToPages extends Migration
{
    public function up()
    {
        $this->forge->addColumn('pages', [
            'show_in_menu' => [
                'type'       => 'TINYINT',
                'constraint' => 1,
                'default'    => 1,
                'after'      => 'status',
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('pages', 'show_in_menu');
    }
}
