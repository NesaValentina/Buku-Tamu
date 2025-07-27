<?php

/**
 * Migrasi untuk tabel buku - Perpustakaan Digital
 * Berisi struktur database untuk menyimpan data buku
 */

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBooksTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_buku' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'judul_buku' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'penulis' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'penerbit' => [
                'type'       => 'VARCHAR',
                'constraint' => '255',
            ],
            'tahun_terbit' => [
                'type'       => 'YEAR',
            ],
            'kategori' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'sinopsis' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);
        
        $this->forge->addKey('id_buku', true);
        $this->forge->createTable('books');
    }

    public function down()
    {
        $this->forge->dropTable('books');
    }
}
