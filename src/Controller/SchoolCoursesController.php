<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * SchoolCourses Controller
 *
 * @property \App\Model\Table\SchoolCoursesTable $SchoolCourses
 * @method \App\Model\Entity\SchoolCourse[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class SchoolCoursesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $this->Authorization->skipAuthorization();
        if ($this->Authentication->getIdentity()->role->name == 'ALUMNO' ) {
            // Traer los datos del estudiante
            $query = $this->SchoolCourses->Students->find('StudentInfo', [
                'user_id' => $this->Authentication->getIdentity()->getIdentifier()
            ])->all();

            $row = $query->first();

            $options = [
                'school_level_id' => $row->sl_id,
                'sex' => $row->sex
            ];
            
            // Traer los cursos relacionados con el grado escolar, sexo y la edad del estudiante
            $schoolCourses = $this->SchoolCourses->find('CoursesForStudent', $options)->all();
        } else {
            $schoolCourses = $this->SchoolCourses->find('all')
                ->contain(['Subjects', 'Teachers', 'Terms'])
                ->all();
        }

        $this->set(compact('schoolCourses'));
    }

    /**
     * View method
     *
     * @param string|null $id School Course id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $schoolCourse = $this->SchoolCourses->get($id, [
            'contain' => ['Subjects', 'Teachers', 'Terms', 'Schedules', 'Students'],
        ]);
        $this->Authorization->authorize($schoolCourse);
        $this->set(compact('schoolCourse'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $schoolCourse = $this->SchoolCourses->newEmptyEntity();
        $this->Authorization->authorize($schoolCourse);
        if ($this->request->is('post')) {
            $schoolCourse = $this->SchoolCourses->patchEntity($schoolCourse, $this->request->getData());
            if ($this->SchoolCourses->save($schoolCourse)) {
                $this->Flash->success(__('The school course has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The school course could not be saved. Please, try again.'));
        }
        $subjects = $this->SchoolCourses->Subjects->find('list', ['limit' => 200])->all();
        $teachers = $this->SchoolCourses->Teachers->find('list', ['limit' => 200])->all();
        $terms = $this->SchoolCourses->Terms->find('list', ['limit' => 200])->all();
        $schedules = $this->SchoolCourses->Schedules->find('list', ['limit' => 200])->all();
        $students = $this->SchoolCourses->Students->find('list', ['limit' => 200])->all();
        $this->set(compact('schoolCourse', 'subjects', 'teachers', 'terms', 'schedules', 'students'));
    }

    /**
     * Edit method
     *
     * @param string|null $id School Course id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $schoolCourse = $this->SchoolCourses->get($id, [
            'contain' => ['Schedules', 'Students'],
        ]);
        $this->Authorization->authorize($schoolCourse);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $schoolCourse = $this->SchoolCourses->patchEntity($schoolCourse, $this->request->getData());
            if ($this->SchoolCourses->save($schoolCourse)) {
                $this->Flash->success(__('The school course has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The school course could not be saved. Please, try again.'));
        }
        $subjects = $this->SchoolCourses->Subjects->find('list', ['limit' => 200])->all();
        $teachers = $this->SchoolCourses->Teachers->find('list', ['limit' => 200])->all();
        $terms = $this->SchoolCourses->Terms->find('list', ['limit' => 200])->all();
        $schedules = $this->SchoolCourses->Schedules->find('list', ['limit' => 200])->all();
        $students = $this->SchoolCourses->Students->find('list', ['limit' => 200])->all();
        $this->set(compact('schoolCourse', 'subjects', 'teachers', 'terms', 'schedules', 'students'));
    }

    /**
     * Delete method
     *
     * @param string|null $id School Course id.
     * @return \Cake\Http\Response|null|void Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $schoolCourse = $this->SchoolCourses->get($id);
        $this->Authorization->authorize($schoolCourse);
        if ($this->SchoolCourses->delete($schoolCourse)) {
            $this->Flash->success(__('The school course has been deleted.'));
        } else {
            $this->Flash->error(__('The school course could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function signup() {
        $this->Authorization->skipAuthorization();
        $user_id = $this->Authentication->getIdentity()->getIdentifier();
        if ($this->Authentication->getIdentity()->role->name == 'ALUMNO' ) {
            $query = $this->SchoolCourses->Students->find('StudentInfo', [
                'user_id' => $user_id
            ])->all();
            $row = $query->first();

            $options = [
                'school_level_id' => $row->sl_id,
                'sex' => $row->sex
            ];
            
            // Traer los cursos relacionados con el grado escolar, sexo y la edad del estudiante
            $schoolCourses = $this->SchoolCourses->find('CoursesForStudent', $options)->all();
        }
        $this->set(compact('schoolCourses'));
    }
}
