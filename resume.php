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

function resume_save($user_id, $resume) {

  $resume_id = resume_lookup_id_for_user($user_id);

  if($resume_id == NULL) {
    $resume_id  = _resume_insert_resume($user_id, $resume);
    $newly_created = true;
  } else {
    #update
    _resume_update_resume($resume_id, $resume);
    $newly_created = false;
  }

  #update
  _resume_update_experiences($resume_id, $resume->experiences);
  _resume_update_educations($resume_id, $resume->educations);
  _resume_update_references($resume_id, $resume->references);

  if($newly_created) {
    return $resume_id;
  } else {
    return NULL;
  }
}

function _resume_insert_resume($user_id, $resume) {
  $connection = db_open();

  // insert
  $query = "
  INSERT INTO resumes
  (UserID, Introduction, KeyPoints)
  VALUES
  (?,?,?)
  ";

  $statement = $connection->prepare($query);
  $statement->bind_param('iss', $user_id, $resume->introduction, $resume->key_points);
  $statement->execute();
  $resume_id = $connection->insert_id;
  $statement->close();

  return $resume_id;
}

function _resume_update_resume($resume_id, $resume) {
  $connection = db_open();

  // insert
  $query = "
  UPDATE resumes
  SET Introduction=?,
      KeyPoints=?
  WHERE ResumeID = ?
  ";

  $statement = $connection->prepare($query);
  $statement->bind_param('ssi', $resume->introduction, $resume->key_points, $resume_id);
  $statement->execute();
  $statement->close();
}

function _resume_update_experiences($resume_id, $experiences) {
    $connection = db_open();

    // delete current associated experiences
    $query = 'delete from resumeexperience where ResumeID = ?';
    $statement = $connection->prepare($query);
    $statement->bind_param('i', $resume_id);
    $statement->execute();
    $statement->close();

    // delete unused experiences
    $query = 'DELETE FROM experience WHERE ExperienceID NOT IN ( SELECT ExperienceID FROM resumeexperience)';
    $statement = $connection->prepare($query);
    $statement->execute();
    $statement->close();

    //insert experiences
    $experience_ids = [];
    $query = 'insert into experience (Title, Company, StartDate, EndDate, Description) values (?, ?, FROM_UNIXTIME(?), FROM_UNIXTIME(?), ?)';
    $statement = $connection->prepare($query);
    foreach($experiences as $experience) {
      $statement->bind_param('ssiis', $experience->title, $experience->company, $experience->start_date, $experience->end_date, $experience->description);
      $statement->execute();
      $experience_ids[] = $connection->insert_id;
    }
    $statement->close();

    // insert experience xref
    $query = 'insert into resumeexperience (ResumeID, ExperienceID) values (?, ?)';
    $statement = $connection->prepare($query);
    foreach($experience_ids as $experience_id) {
      $statement->bind_param('ii', $resume_id, $experience_id);
      $statement->execute();
    }
    $statement->close();
}


function _resume_update_educations($resume_id, $educations) {
    $connection = db_open();

    // delete current associated educations
    $query = 'delete from resumeeducation where ResumeID = ?';
    $statement = $connection->prepare($query);
    $statement->bind_param('i', $resume_id);
    $statement->execute();
    $statement->close();

    // delete unused educations
    $query = 'DELETE FROM education WHERE EducationID NOT IN ( SELECT EducationID FROM resumeeducation)';
    $statement = $connection->prepare($query);
    $statement->execute();
    $statement->close();

    //insert educations
    $education_ids = [];
    $query = 'insert into education (Degree, School, StartDate, EndDate, CourseList, Description) values (?, ?, FROM_UNIXTIME(?), FROM_UNIXTIME(?), ?, ?)';
    $statement = $connection->prepare($query);
    foreach($educations as $education) {
      $statement->bind_param('ssiiss', $education->degree, $education->school, $education->start_date, $education->end_date, $education->course_list, $education->description);
      $statement->execute();
      $education_ids[] = $connection->insert_id;
    }
    $statement->close();

    // insert education xref
    $query = 'insert into resumeeducation (ResumeID, EducationID) values (?, ?)';
    $statement = $connection->prepare($query);
    foreach($education_ids as $education_id) {
      $statement->bind_param('ii', $resume_id, $education_id);
      $statement->execute();
    }
    $statement->close();
}


function _resume_update_references($resume_id, $references) {
    $connection = db_open();

    // delete current associated references
    $query = 'delete from resumereferences where ResumeID = ?';
    $statement = $connection->prepare($query);
    $statement->bind_param('i', $resume_id);
    $statement->execute();
    $statement->close();

    // delete unused references
    $query = 'DELETE FROM codefest.references WHERE ReferenceID NOT IN ( SELECT ReferenceID FROM resumereferences)';
    $statement = $connection->prepare($query);
    $statement->execute();
    $statement->close();

    //insert references
    $reference_ids = [];
    $query = 'insert into codefest.references (FirstName, LastName, Phone, Email, Relation) values (?, ?, ?, ?, ?)';
    $statement = $connection->prepare($query);
    foreach($references as $reference) {
      $statement->bind_param('sssss', $reference->first_name, $reference->last_name, $reference->phone, $reference->email, $reference->relation);
      $statement->execute();
      $reference_ids[] = $connection->insert_id;
    }
    $statement->close();

    // insert reference xref
    $query = 'insert into resumereferences (ResumeID, ReferenceID) values (?, ?)';
    $statement = $connection->prepare($query);
    foreach($reference_ids as $reference_id) {
      $statement->bind_param('ii', $resume_id, $reference_id);
      $statement->execute();
    }
    $statement->close();
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
  $resume->id = $resume_id;
  $resume->person = $person;


  $statement = $connection->prepare($query);
  $statement->bind_param('i', $resume_id);
  $statement->bind_result($resume->introduction, $resume->key_points,
                          $person->first_name, $person->last_name,
                          $person->middle_initial, $person->suffix,
                          $person->email, $person->phone);
  $statement->execute();
  $statement->store_result();
  $statement->fetch();
  $found = $statement->num_rows > 0;

  $statement->close();

  if(!$found) {
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
