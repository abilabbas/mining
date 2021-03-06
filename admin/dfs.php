<?php include "test1.php";?>
<?php
class Node
{
    public $item;
    public $linked = array();
    public function __construct($name)
    {
        $this->name = $name;
    }
    public function link_to(Node $node, $also = true)
    {
        if (!$this->linked($node)) $this->linked[] = $node;
        if ($also) $node->link_to($this, false);
        return $this;
    }
    private function linked(Node $node)
    {
        foreach ($this->linked as $l) { if ($l->name === $node->name) return true; }
        return false;
    }
    public function not_visited_nodes($visited_names)
    {
        $ret = array();
        foreach ($this->linked as $l) {
            if (!in_array($l->name, $visited_names)) $ret[] = $l;
        }
        return $ret;
    }
}
/* Building Graph */
$root = new Node('root');
        $name = $item;
        //$$name = new Node($name);
}

/* Searching Path */
function dfs(Node $node, $path = '', $visited = array())
{
    $visited[] = $node->name;
    $not_visited = $node->not_visited_nodes($visited);
    if (empty($not_visited)) {
        echo 'path : ' . $path . '->' . $node->name . PHP_EOL;
        echo "<br>";
        return;
    }
    foreach ($not_visited as $n) dfs($n, $path . '->' . $node->name, $visited);
}
dfs($root);
// path : ->root->node1->node3
// path : ->root->node1->node4->node5->node2->node6
// path : ->root->node2->node5->node4->node1->node3
// path : ->root->node2->node6