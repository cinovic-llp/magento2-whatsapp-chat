<?php
/**
 * Cinovic Technologies LLP.
 *
 * @category  Cinovic
 * @package   Cinovic_Whatsapp
 * @author    Cinovic
 * @copyright Copyright (c) Cinovic Technologies LLP (https://cinovic.com)
 * @license   https://store.cinovic.com/license.html
 */

namespace Cinovic\Whatsapp\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class InstallSchema implements InstallSchemaInterface
{

	public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
	{
		$installer = $setup;
		$installer->startSetup();
		if (!$installer->tableExists('cinovic_whatsapptable')) {
				$table = $installer->getConnection()
					->newTable($installer->getTable('cinovic_whatsapptable')
				)
				->addColumn(
					'entity_id',
					\Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
					null,
					[
						'identity' => true,
						'nullable' => false,
						'primary'  => true,
						'unsigned' => true,
					],
					'Entity ID'
				)
				->addColumn(
            'name',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Name'
				)
				->addColumn(
            'department_name',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Department Name'
				)
				->addColumn(
            'custom_message',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            ['nullable' => false],
            'Custom Message'
				)
				->addColumn(
            'number',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            11,
            ['nullable' => false],
            'Number'
        )
				->addColumn(
						'image_url',
						\Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
						255,
						[],
						'Image Url'
				)
				->addColumn(
						'disable_enable',
						\Magento\Framework\DB\Ddl\Table::TYPE_FLOAT,
						6,
						['default' => 1],
						'disable/enable'
				)
				->addColumn(
						'created_at',
						\Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
						null,
						['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT],
						'Created At'
				)->addColumn(
						'updated_at',
						\Magento\Framework\DB\Ddl\Table::TYPE_TIMESTAMP,
						null,
						['nullable' => false, 'default' => \Magento\Framework\DB\Ddl\Table::TIMESTAMP_INIT_UPDATE],
						'Updated At'
				)
				->setComment('video Table');
			$installer->getConnection()->createTable($table);
		}
		$installer->endSetup();
	}
}
