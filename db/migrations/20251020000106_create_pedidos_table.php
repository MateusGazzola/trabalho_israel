<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreatePedidosTable extends AbstractMigration
{
    public function change(): void
    {
        $this->table('pedidos')
            ->addColumn('cliente_id', 'integer', ['signed' => false])
            ->addColumn('product_id', 'integer', ['signed' => false])
            ->addColumn('forma_pagamento_id', 'integer', ['signed' => false])
            ->addColumn('quantidade', 'integer', ['default' => 1])
            ->addColumn('valor_total', 'decimal', ['precision' => 10, 'scale' => 2])
            ->addColumn('status', 'string', ['limit' => 50, 'default' => 'pendente'])
            ->addColumn('created_at', 'timestamp', ['default' => 'CURRENT_TIMESTAMP'])
            ->addForeignKey('cliente_id', 'clientes', 'id', ['delete' => 'NO ACTION', 'update' => 'NO ACTION'])
            ->addForeignKey('product_id', 'products', 'id', ['delete' => 'NO ACTION', 'update' => 'NO ACTION'])
            ->addForeignKey('forma_pagamento_id', 'formas_pagamento', 'id', ['delete' => 'NO ACTION', 'update' => 'NO ACTION'])
            ->create();
    }
}

