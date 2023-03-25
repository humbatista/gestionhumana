<?php

declare (strict_types=1);
namespace Rector\NodeTypeResolver\PhpDoc\PhpDocNodeTraverser;

use Rector\NodeTypeResolver\PhpDocNodeVisitor\ClassRenamePhpDocNodeVisitor;
use RectorPrefix20210909\Symplify\SimplePhpDocParser\PhpDocNodeTraverser;
final class RenamingPhpDocNodeVisitorFactory
{
    /**
     * @var \Rector\NodeTypeResolver\PhpDocNodeVisitor\ClassRenamePhpDocNodeVisitor
     */
    private $classRenamePhpDocNodeVisitor;
    public function __construct(\Rector\NodeTypeResolver\PhpDocNodeVisitor\ClassRenamePhpDocNodeVisitor $classRenamePhpDocNodeVisitor)
    {
        $this->classRenamePhpDocNodeVisitor = $classRenamePhpDocNodeVisitor;
    }
    public function create() : \RectorPrefix20210909\Symplify\SimplePhpDocParser\PhpDocNodeTraverser
    {
        $phpDocNodeTraverser = new \RectorPrefix20210909\Symplify\SimplePhpDocParser\PhpDocNodeTraverser();
        $phpDocNodeTraverser->addPhpDocNodeVisitor($this->classRenamePhpDocNodeVisitor);
        return $phpDocNodeTraverser;
    }
}