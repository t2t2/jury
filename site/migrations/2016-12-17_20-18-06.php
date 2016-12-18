<?php

class Migration_2016_12_17_20_18_06 extends FieldMigration {

	public static $description = "Create summary field";

	protected function getFieldName(){ return 'summary'; }

	protected function getFieldType(){ return 'FieldtypeTextarea'; }

	protected function fieldSetup(Field $f){
        $f->label = 'Summary';
        $f->textformatters = ['TextformatterEntities'];
        $f->rows = 3;
    }

}