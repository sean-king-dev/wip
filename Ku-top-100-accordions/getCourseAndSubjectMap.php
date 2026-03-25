<?php
/*
 * Snippet: getCourseAndSubjectMaps
 * Returns JS objects mapping course IDs and subject IDs to pagetitles
 */
// Fetch all courses
$courses = $modx->getCollection('modResource', [
    'parent' => 44,  // Courses parent
    'published' => 1,
    'deleted' => 0,
]);
 
// Fetch all subjects
$subjects = $modx->getCollection('modResource', [
    'parent' => 389, // Subjects parent
    'published' => 1,
    'deleted' => 0,
]);
 
// Build mapping arrays
$courseMap = [];
foreach ($courses as $course) {
    $courseMap[$course->get('id')] = $course->get('pagetitle');
}
 
$subjectMap = [];
foreach ($subjects as $subject) {
    $subjectMap[$subject->get('id')] = $subject->get('pagetitle');
}
 
// Output JS
return "<script>
    window.courseMap = " . json_encode($courseMap) . ";
    window.subjectMap = " . json_encode($subjectMap) . ";
    console.log('Course map:', window.courseMap);
    console.log('Subject map:', window.subjectMap);
</script>";