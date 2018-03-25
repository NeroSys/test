<?php

use yii\db\Migration;

/**
 * Class m180324_110005_catalogue_tables
 */
class m180324_110005_catalogue_tables extends Migration
{
    public function safeUp()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%days}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(20)->notNull()

        ], $tableOptions);

        $this->createTable('{{%work_time}}', [
            'id' => $this->primaryKey(),
            'workDays_id' => $this->smallInteger(1),
            'start_at' => $this->time()->defaultValue(null),
            'end_at' => $this->time()->defaultValue(null),

        ], $tableOptions);

        $this->createTable('{{%work_days}}', [
            'id' => $this->primaryKey(),
            'store_id' => $this->integer(50),
            'day_id' => $this->smallInteger(1)

        ], $tableOptions);


        $this->createTable('{{%stores}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string(255)->notNull(),

        ], $tableOptions);


        //Создание индексов в таблице work_days
        $this->createIndex('FK_stores', '{{%work_days}}', 'store_id');
        $this->createIndex('FK_days', '{{%work_days}}', 'day_id');

        //Создание индексов в таблице work_time
        $this->createIndex('FK_day_id', '{{%work_time}}', 'workDays_id');


//        связи


        $this->addForeignKey(
            'FK_day_store', '{{%work_days}}', 'store_id', '{{%stores}}', 'id', 'CASCADE', 'RESTRICT'
        );

        $this->addForeignKey(
            'FK_day_time', '{{%work_time}}', 'workDays_id', '{{%work_days}}', 'id', 'CASCADE', 'RESTRICT'
        );

        $this->batchInsert('days', ['name'], [
            ['Понедельник'],
            ['Вторник'],
            ['Среда'],
            ['Четверг'],
            ['Пятница'],
            ['Суббота'],
            ['Воскресенье'],
        ]);
    }

    public function safeDown()
    {
        $this->dropTable('{{%days}}');
        $this->dropTable('{{%work_time}}');
        $this->dropTable('{{%work_days}}');
        $this->dropTable('{{%stores}}');
    }
}
