<?php
namespace App\DQL;

use Doctrine\ORM\Query\AST\Functions\FunctionNode;
use Doctrine\ORM\Query\TokenType;
use Doctrine\ORM\Query\Parser;
use Doctrine\ORM\Query\SqlWalker;

class CastFunction extends FunctionNode
{
    public $expression = null;
    public $type = null;

    public function parse(Parser $parser) : void
    {
        $lexer = $parser->getLexer();

        $parser->match(TokenType::T_IDENTIFIER); // CAST
        $parser->match(TokenType::T_OPEN_PARENTHESIS); // (

        // Expression à caster
        $this->expression = $parser->ArithmeticPrimary(); // u.roles

        // Reconnaît AS
        $parser->match(TokenType::T_AS); // AS

        // Type cible

        $parser->match(TokenType::T_IDENTIFIER);
        $this->type = $lexer->token->value; //text literal

        $parser->match(TokenType::T_CLOSE_PARENTHESIS); // )

    }

    public function getSql(SqlWalker $sqlWalker) : string
    {
        return sprintf(
            'CAST(%s AS %s)',
            $this->expression->dispatch($sqlWalker),
            $this->type
        );
    }
}
