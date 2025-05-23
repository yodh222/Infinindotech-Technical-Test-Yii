<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%orders}}`.
 */
class m250523_094635_create_orders_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%orders}}', [
            'id' => $this->primaryKey(),
            'customer_id' => $this->integer(),
            'product_id' => $this->integer(),
            'jumlah_dibeli' => $this->integer(),
            'no_faktur' => $this->string(23),
            'total_harga' => $this->integer(),
            'created_at' => $this->timestamp(),
            'updated_at' => $this->timestamp()
        ]);

        $this->execute("
        ALTER TABLE orders
        ADD COLUMN status ENUM('Lunas', 'Belum Lunas') NOT NULL DEFAULT 'Belum Lunas' AFTER total_harga
        ");

        $this->addForeignKey(
            "fk_orders_customer",
            "orders",
            "customer_id",
            "customers",
            "id",
            "CASCADE",
            "CASCADE"
        );

        $this->addForeignKey(
            "fk_orders_product",
            "orders",
            "product_id",
            "products",
            "id",
            "CASCADE",
            "CASCADE"
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%orders}}');
    }
}