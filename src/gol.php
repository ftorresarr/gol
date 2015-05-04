<?php
/**
 * User: Fernando Torres Arreola
 * Date: 27/04/15
 * Time: 17:52
 * Esta clase acepta un arreglo con 0s y 1s, cuando se ejecuta el metodo iterate(n) regresa la generacion deseada
 * Ej. $gol = new GoL($genData);
 *	$gol->iterate();
 *      $gol = new GoL($genData);
 *      $gol->iterate(10);
 *      $gol->setGenData($genData)->iterate()
 */

class GoL {
    private $_genData, $_genCopy;

    /**
     * @param $_inputArr array arreglo, los estados de cada cuadro debe de ser 0 para vivo y 1 para muerto
     * @return $this GoL
     */
    public function __construct(array $_inputArr){
        try{
            $this->_genData = $_inputArr;
            return $this;
        }catch (Exception $e){
            return $e->getMessage();
        }
    }

    /**
     * @param $_inputArr array arreglo, los estados de cada cuadro debe de ser 0 para vivo y 1 para muerto
     * @return $this
     * Reemplaza los datos sin tener que re-¡nstanciar la clase
     */
    public function setGenData(array $_inputArr){
        try{
            $this->_genData = $_inputArr;
            return $this;
        }catch (Exception $e){
            return $e->getMessage();
        }
    }

    /**
     * @param $numGens int numero de generaciones, en entero por default calculamos una generación
     * @return array resultado de las iteraciones
     */
    public function iterate($numGens = 1){
        try{
            for($i = 0 ; $i < $numGens ; $i++){
                $this->_execGen();
                $this->_genData = $this->_genCopy;
            }
            return $this->_genData;
        }catch (Exception $e){
            return $e->getMessage();
        }
    }

    /**
     * Ejecuta iteración
     */
    private function _execGen(){
        $this->_genCopy = [];
        array_walk($this->_genData,array($this,'rowCallback'));
    }

    /**
     * @param $row int coordenada x
     * @param $col int coordenada y
     * @return bool vivo o muerto
     */

    private function _getCellState($row, $col, $state){
        $numNei = $this->_getNeighboors($row,$col);
        return ($this->_genData[$row][$col] && $numNei == 2) || $numNei === 3;
    }

    /**
     * @param $row int coordenada x
     * @param $col int coordenada y
     * @return int numero de vecinos
     * Suma los elementos vivos y muertos que rodean al elemento del cual la informacion se solicita
     */
    private function _getNeighboors($row, $col)//row , col
    {
        return $this->_returnCell($row-1,$col-1)+     $this->_returnCell($row-1,$col)+      $this->_returnCell($row-1,$col+1)+
                $this->_returnCell($row,$col-1)+       /* elemento actual */                $this->_returnCell($row,$col+1)+
                $this->_returnCell($row+1,$col-1)+     $this->_returnCell($row+1,$col)+      $this->_returnCell($row+1,$col+1);
    }

    /**
     * @param $row int
     * @param $col int
     * @return int
     * Permite añadir cualquier numero para el status de vivo, a la vez proteje de indices inválidos
     */
    private function _returnCell($row,$col){
        return (int)(isset($this->_genData[$row][$col]) && (bool)$this->_genData[$row][$col]);
    }
    /**
     * @param $item array fila a ser procesada
     * @param $key int coordenada de posicion
     * Esta funcion recibe una fila que luego es procesada
     */
    private function rowCallback($item, $key)
    {
        array_walk($item,array($this,'columnCallback'),$key);
    }

    /**
     * @param $item int estado vivo o muerto (1 o 0)
     * @param $key int coordenada de posicion
     * @param $col int coordenada de posicion
     * Procesa las celulas
     */

    private function columnCallback($item, $key, $col)
    {
        $this->_genCopy[$key][$col] = (int) $this->_getCellState($key,$col , $item);
    }
}
