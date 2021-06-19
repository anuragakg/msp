<?php

use Illuminate\Database\Seeder;
use App\Models\EmailTemplate;

class EmailTemplatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        EmailTemplate::truncate();
        $templates = [
   
		          [
		            "description" => "Hi __name__,<br>

		                            Sample Email.<br>

		                            For testing purpose only.<br>

		                            Stay safe,<br>
		                            Trifed Team<br>
		                            <br>
		                        Trifed<br>
		                        We got you covered",
		            "type" => "Trifed-Demo",
		            "subject" => "TRIFED-Email-Template"
		          ]
        ];
        
        DB::table('email_templates')->insert($templates);
    }
}

