<?php
include_once 'db.php';

function resume_lookup_id_for_user($user_id) {
  $connection = db_open();

  $query = 'select max(ResumeID) from resumes where UserId = ?';
  $statement = $connection->prepare($query);
  $statement->bind_param('i', $user_id);
  $statement->bind_result($resume_id);
  $statement->execute();
  $statement->fetch();
  $statement->close();
  if($resume_id) {
    return $resume_id;
  } else {
    return NULL;
  }
}


function resume_load($resume_id) {
  if(empty($resume_id)) {
      return NULL;
  }

  $connection = db_open();

    $query = <<< EOQ
    select r.introduction, r.KeyPoints,
           u.FirstName, u.LastName, u.MiddleInitial, u.Suffix,
           u.Email, u.phone
    from resumes r
    join users u
      on u.UserId = r.UserId
    where r.ResumeId = ?
EOQ;

  $person = new stdClass;
  $resume = new stdClass;
  $resume->person = $person;


  $statement = $connection->prepare($query);
  $statement->bind_param('i', $resume_id);
  $statement->bind_result($resume->introduction, $resume->key_points,
                          $person->first_name, $person->last_name,
                          $person->middle_initial, $person->suffix,
                          $person->email, $person->phone);
  $statement->execute();
  $statement->fetch();
  $statement->close();

  if($connection->field_count <= 0) {
    //no results
    return NULL;
  }

  $resume->experiences = _resume_load_experiences($resume_id);
  $resume->educations = _resume_load_educations($resume_id);
  $resume->references = _resume_load_references($resume_id);


  return $resume;
}

function _resume_load_experiences($resume_id) {

        $connection = db_open();

          $query = <<< EOQ
          select r.Title, r.Company, r.StartDate, r.EndDate, r.Description
          from experience r
          join resumeexperience x
            on x.ExperienceID = r.ExperienceID
          where x.ResumeId = ?
EOQ;

        $experiences = [];

        $statement = $connection->prepare($query);
        $statement->bind_param('i', $resume_id);
        $statement->bind_result($title, $company,
                                $start_date, $end_date, $description);
        $statement->execute();
        while ($statement->fetch()) {
          $experience = new stdClass;
          $experience->title = $title;
          $experience->company = $company;
          $experience->start_date = $start_date;
          $experience->end_date =  $end_date;
          $experience->description = $description;
          $experiences[] = $experience;
        }
        $statement->close();

        return $experiences;
}

function _resume_load_educations($resume_id) {

      $connection = db_open();

        $query = <<< EOQ
        select r.Degree, r.School, r.StartDate, r.EndDate, r.CourseList, r.Description
        from education r
        join resumeeducation x
          on x.EducationID = r.EducationID
        where x.ResumeId = ?
EOQ;

      $educations = [];

      $statement = $connection->prepare($query);
      $statement->bind_param('i', $resume_id);
      $statement->bind_result($degree, $school,
                              $start_date, $end_date, $course_list, $description);
      $statement->execute();
      while ($statement->fetch()) {
        $education = new stdClass;
        $education->degree = $degree;
        $education->school = $school;
        $education->start_date = $start_date;
        $education->end_date =  $end_date;
        $education->course_list = $course_list;
        $education->description = $description;
        $educations[] = $education;
      }
      $statement->close();

      return $educations;
}

function _resume_load_references($resume_id) {

    $connection = db_open();

      $query = <<< EOQ
      select r.FirstName, r.LastName, r.Email, r.Phone, r.Relation
      from codefest.references r
      join resumereferences x
        on x.ReferenceID = r.ReferenceID
      where x.ResumeId = ?
EOQ;

    $references = [];

    $statement = $connection->prepare($query);
    $statement->bind_param('i', $resume_id);
    $statement->bind_result($first_name, $last_name,
                            $email, $phone, $relation);
    $statement->execute();
    while ($statement->fetch()) {
      $person = new stdClass;
      $person->first_name = $first_name;
      $person->last_name = $last_name;
      $person->email = $email;
      $person->phone =  $phone;
      $person->relation = $relation;
      $references[] = $person;
    }
    $statement->close();

    return $references;
}


?>
