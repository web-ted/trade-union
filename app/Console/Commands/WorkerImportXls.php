<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Facades\Excel;
use App\Worker;
use App\Enterprise;
use App\Specialty;
use DB;


class WorkerImportXls extends Command
{
	/**
	 * The name and signature of the console command.
	 *
	 * @var string
	 */
	protected $signature = 'worker:import';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Import xlsx files into workers table';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function handle()
	{
		$filename = base_path('files') . DIRECTORY_SEPARATOR . 'mitroo.xlsx';
		$this->info('Reading xlsx file: ' . $filename);
		$rs = Excel::load($filename, function ($reader) {})->get();


		$this->info('Truncating main tables: workers, enterprises, specialties');
		DB::table('workers')->truncate();
		DB::table('enterprises')->truncate();
		DB::table('specialties')->truncate();

		$this->info('Preparing tables for data import');
		Worker::unguard();
		Enterprise::unguard();
		Specialty::unguard();

		$this->info('Trying to import: '.$rs->count().' rows');
		foreach ($rs as $row) {
			list($surname, $name) = explode(' ', $row['onomatepwnymo']);
			if (!empty($row['epaggelma'])) {
				try {
					$specialty = Specialty::firstOrCreate(['name' => $row['epaggelma']]);
					$specialty_id = $specialty->id;
				} catch (\Exception $e) {
					$this->error('ERROR: Importing Specialty "' . $row['epaggelma'] . '" failed');
					$this->error($e->getMessage());
					dd($row);
					exit;
				}
			} else {
				$specialty_id = null;
			}


			if ($row['epixeirhsh']) {
				try {
					$enterprise = Enterprise::firstOrCreate(['name' => $row['epixeirhsh']]);
					$enterprise_id = $enterprise->id;
				} catch (\Exception $e) {
					$this->error('ERROR: Importing Enterprise "' . $row['epixeirhsh'] . '" failed');
					dd($row);
					exit;
				}
			} else {
				$enterprise_id = null;
			}

			if (!is_null($row['etos_gennh_sews'])) {
				if (preg_match("/^\d{4}$/", $row['etos_gennh_sews'])) {
					$row['etos_gennh_sews'] = $row['etos_gennh_sews'] . '-01-01 00:00:00';
				}

				if (preg_match("/^\d{1,2}\/\d{1,2}\/\d{2,4}$/", $row['etos_gennh_sews'])) {
					// $parts = explode('/', $row['etos_gennh_sews'],3);
					$row['etos_gennh_sews'] = date_create_from_format("d/m/Y", $row['etos_gennh_sews'])->format('Y-m-d');
				}
			}

			try {
				$worker = [
					'active'              => true,
					'registration_number' => (int)$row['aa'],
					'registered_at'       => ($row['eggrafh'] instanceof Carbon) ? $row['eggrafh']->toW3cString() : $row['eggrafh'],
					'first_name'          => $name,
					'last_name'           => $surname,
					'father_name'         => $row['patrwnymo'],
					'birth_date'          => $row['etos_gennh_sews'],
					'id_card'             => $row['a.d.t.'],
					'phone'               => $row['thlefwno'],
					'mobile_phone'        => null,
					'email'               => null,
					'address'             => $row['dieyoynsh_katoikias'],
					'postal_code'         => $row['tk'] ?? null,
					'region'              => null,
					'city'                => $row['polh'],
					'hire_date'           => null,
					'insurance_number'    => null,
					'comment'             => null,
					'enterprise_id'       => $enterprise_id,
					'specialty_id'        => $specialty_id,
					'created_at'          => time(),
					'updated_at'          => null,
				];

				// dd($worker);
				
				$result = Worker::create($worker);
			} catch (\Exception $e) {
				$this->error('ERROR: Importing Worker "' . $row['onomatepwnymo'] . '" failed');
				$this->info($e->getMessage());
				dd($row);
				exit;
			}

		}
	}
}
