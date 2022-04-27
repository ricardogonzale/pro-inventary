<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id_project
 * @property string $name
 * @property string $date_start
 * @property string $date_end
 * @property int $id_city
 * @property int $id_state
 * @property string $Street
 * @property int $zip_code
 * @property string $team_leader
 * @property int $id_client
 * @property string $mun_project
 * @property int $id_branch
 * @property int $id_company
 * @property int $division_name
 * @property string $woork_week
 * @property string $job_type
 * @property int $Crew
 * @property string $work_shift
 * @property string $note
 * @property string $status_prj
 * @property string $status_calend
 * @property string $period
 * @property int $category
 * @property string $recur_info
 * @property string $event_color
 * @property string $creator
 * @property string $reminder
 * @property string $recurrence
 * @property string $description
 */
class Project extends Model
{
    /**
     * The table associated with the model.
     * 
     * @var string
     */
    protected $table = 'project';

    /**
     * The primary key for the model.
     * 
     * @var string
     */
    protected $primaryKey = 'id_project';

    /**
     * @var array
     */
    protected $fillable = ['name', 'date_start', 'date_end', 'id_city', 'id_state', 'Street', 'zip_code', 'team_leader', 'id_client', 'mun_project', 'id_branch', 'id_company', 'division_name', 'woork_week', 'job_type', 'Crew', 'work_shift', 'note', 'status_prj', 'status_calend', 'period', 'category', 'recur_info', 'event_color', 'creator', 'reminder', 'recurrence', 'description'];
}
