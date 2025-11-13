<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateClientesTable extends AbstractMigration
{
    public function change(): void
    {
        $this->table('clientes')
            ->addColumn('nome', 'string', ['limit' => 100])
            ->addColumn('email', 'string', ['limit' => 100])
            ->addColumn('telefone', 'string', ['limit' => 20, 'null' => true])
            ->addColumn('endereco', 'string', ['limit' => 255, 'null' => true])
            ->addColumn('cidade', 'string', ['limit' => 100, 'null' => true])
            ->addColumn('estado', 'string', ['limit' => 2, 'null' => true])
            ->addColumn('cep', 'string', ['limit' => 10, 'null' => true])
            ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addIndex(['email'], ['unique' => true])
            ->create();
    }
}

