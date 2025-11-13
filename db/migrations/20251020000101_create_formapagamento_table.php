<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateFormaPagamentoTable extends AbstractMigration
{
    public function change(): void
    {
        $this->table('formas_pagamento')
            ->addColumn('descricao', 'string', ['limit' => 100])
            ->addColumn('tipo_pagamento', 'string', ['limit' => 50, 'null' => true])
            ->create();
            
    }
}
