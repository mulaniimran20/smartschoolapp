<?php

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Teachersubject_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        $this->current_session = $this->setting_model->getCurrentSession();
    }

    public function getSubjectByClsandSection($class_id, $section_id)
    {
        $where = " ";
        $sql = "SELECT subjects.*,staff.name as `teacher_name`, staff.*, subject_timetable.*,subject_group_subjects.*,subjects.code FROM `subject_timetable` INNER JOIN subject_group_subjects ON subject_timetable.`subject_group_subject_id` = subject_group_subjects.id INNER JOIN subjects ON subjects.id = subject_group_subjects.subject_group_id INNER JOIN staff ON staff.id = subject_timetable.staff_id  WHERE subject_timetable.class_id =" . $this->db->escape($class_id) . " and subject_timetable.section_id = " . $this->db->escape($section_id) . " and subject_timetable.session_id=" . $this->db->escape($this->current_session) . " " . $where;
        

        $query = $this->db->query($sql);
        return $query->result_array();
    }

}
