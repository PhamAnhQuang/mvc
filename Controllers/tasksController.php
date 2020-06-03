<?php
require(ROOT . 'Models/Task.php');
class tasksController extends Controller
{
    function index()
    {
        

        $tasks = new Task();
        var_dump($tasks);
        $d['tasks'] = $tasks->showAllTasks();
        // var_dump($d['tasks']);
        $this->set($d);
        $this->render("index");
        // var_dump(get_object_vars($tasks);        
        // foreach ($d['tasks'] as $key => $value) {
        //     var_dump($value);
        // }
    }

    function create()
    {
        if (isset($_POST["title"]))
        {
            require(ROOT . 'Models/Task.php');

            $task= new Task();

            if ($task->create($_POST["title"], $_POST["description"]))
            {
                header("Location: " . WEBROOT . "tasks/index");
            }
        }

        $this->render("create");
    }

    function edit($id)
    {
        require(ROOT . 'Models/Task.php');
        $task= new Task();

        $d["task"] = $task->showTask($id);

        if (isset($_POST["title"]))
        {
            if ($task->edit($id, $_POST["title"], $_POST["description"]))
            {
                header("Location: " . WEBROOT . "tasks/index");
            }
        }
        $this->set($d);
        $this->render("edit");
    }

    function delete($id)
    {
        require(ROOT . 'Models/Task.php');

        $task = new Task();
        if ($task->delete($id))
        {
            header("Location: " . WEBROOT . "tasks/index");
        }
    }
}
?>