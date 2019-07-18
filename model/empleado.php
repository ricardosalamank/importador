<?php
class Empleado
{
	private $pdo;
    
    public $id;
    public $nombre;
    public $apellido;

	public function __CONSTRUCT()
	{
		try
		{
			$this->pdo = Database::StartUp();     
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Listar()
	{
		try
		{
			$result = array();

			$stm = $this->pdo->prepare("SELECT * FROM empleado");
			$stm->execute();

			return $stm->fetchAll(PDO::FETCH_OBJ);
		}
		catch(Exception $e)
		{
			die($e->getMessage());
		}
	}

	public function Obtener($id)
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("SELECT * FROM empleado WHERE id = ?");
			          

			$stm->execute(array($id));
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function ObtenerEstructura($tabla)
	{
		try 
		{

            $stm = $this->pdo
                ->prepare("SELECT column_name as columna
                            FROM information_schema.columns
                            WHERE table_name   = ?");

			$stm->execute(array($tabla));
			return $stm->fetchAll(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function idCampana()
	{
		try 
		{
			$stm = $this->pdo
			          ->prepare("select consecutivo from codigos_campanas order by consecutivo desc limit 1");
			          

			$stm->execute();
			return $stm->fetch(PDO::FETCH_OBJ);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Eliminar($id)
	{
		try 
		{
			$stm = $this->pdo
			            ->prepare("DELETE FROM empleado WHERE id = ?");

			$stm->execute(array($id));
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function Actualizar($data)
	{
		try 
		{
			$sql = "UPDATE empleado SET 
						nombre          = ?, 
						apellido        = ?
				    WHERE id = ?";

			$this->pdo->prepare($sql)
			     ->execute(
				    array(
                        $data->nombre,
                        $data->apellido,
                        $data->id
					)
				);
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}

	public function registrar($valores,$tabla)
	{
		try 
		{
		$sql = "INSERT INTO $tabla $valores";

		return $this->pdo->prepare($sql)
		     ->execute();
		} catch (Exception $e) 
		{
			die($e->getMessage());
		}
	}
}