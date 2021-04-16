<?php

namespace ShakilNadim\Treefy;


use Illuminate\Support\Collection;

class Treefy
{
    private $trees = [];
    private $children = [];

    public function makeTrees(Collection $data, string $parentKey, string $childrenKey) : Object {
        $this->separateRootsAndChildren($data, $parentKey)
            ->addChildrenToParents($this->trees, $childrenKey);

        return $this;
    }


    public function getTrees() : array {
        return $this->trees;
    }


    public function separateRootsAndChildren(Collection $data, $parentKey) : Treefy {
        foreach ($data as $node){
            if ($node[$parentKey] === null){
                $this->addRoot($node);
            } else {
                $this->addToChildren($node, $parentKey);
            }
        }

        return $this;
    }


    public function addRoot(Object $node) : void {
        $this->trees[] = $node;
    }


    public function addToChildren(Object $node, string $parentKey) : void {
        $this->children[$node[$parentKey]][] = $node;
    }


    public function addChildrenToParents(array $parents, string $childrenKey) : array {
        foreach ($parents as $root){
            $root[$childrenKey] = array_key_exists($root->id, $this->children)
                ? $this->addChildrenToParents($this->children[$root->id], $childrenKey)
                : null;
        }

        return $parents;
    }

}
