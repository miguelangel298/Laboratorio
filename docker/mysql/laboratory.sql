CREATE DATABASE laravel

USE laravel

-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 16-11-2017 a las 22:42:16
-- Versión del servidor: 10.1.26-MariaDB
-- Versión de PHP: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `laboratoriodr`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `INSERT_Factura` (IN `_IdPersona` INT(11), IN `_IdMoneda` INT, IN `_IdTipoPago` INT, IN `_Total` DOUBLE, IN `_Itbis` DOUBLE, IN `_Descuento` DOUBLE, IN `_TotalPagar` DOUBLE, IN `_ModificadoPor` INT, IN `_Sucursal` INT)  BEGIN
		Set @IdPaciente = (SELECT 	pacientes.IdPaciente
                          FROM 		pacientes
                          WHERE 	pacientes.IdPersona=_IdPersona);
                          
   		SET @Fecha = (SELECT TIMESTAMP(NOW()));
                           
       	INSERT INTO factura (factura.IdPaciente,
                             factura.IdSucursal,
                             factura.Fecha, 
                             factura.IdMoneda,
                             factura.IdTipoPago,
                             factura.Total, 
                             factura.Descuento, 
                             factura.Itbis, 
                             factura.TotalPagar, 
                             factura.IdEstadoFactura, 
                             factura.ModificadoPor)
       	VALUES (@IdPaciente,
                _Sucursal,
                @Fecha, 
                _IdMoneda,
                _IdTipoPago,
                _Total, 
                _Descuento, 
                _Itbis, 
                _TotalPagar, 
                1, 
                _ModificadoPor);
                
        SET @IdFactura= (SELECT factura.IdFactura 
                         FROM factura 
                         WHERE factura.IdPaciente = @IdPaciente 
                         ORDER BY factura.IdFactura DESC 
                         LIMIT 1);
        
       	INSERT INTO hitorialfactura (hitorialfactura.IdFactura, 
                                     hitorialfactura.IdPaciente, 
                                     hitorialfactura.Fecha, 
                                     hitorialfactura.IdMoneda,
                                     hitorialfactura.IdTipoPago,
                                     hitorialfactura.Total, 
                                     hitorialfactura.Descuento,
                                     hitorialfactura.Itbis,
                                     hitorialfactura.TotalPagar,
                                     hitorialfactura.IdEstadoFactura,
                                     hitorialfactura.ModificadoPor,
                                     hitorialfactura.FechaModificacion)
       	VALUES (@IdFactura, 
                @IdPaciente, 
                @Fecha, 
                _IdMoneda,
                _IdTipoPago,
                _Total, 
                _Descuento, 
                _Itbis, 
                _TotalPagar, 
                1, 
                _ModificadoPor, 
                TIMESTAMP(NOW()));
	END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `INSERT_PersonaEmpleado` (IN `_Cedula` VARCHAR(50), IN `_Nombres` VARCHAR(40), IN `_Apellido1` VARCHAR(40), IN `_Apellido2` VARCHAR(40), IN `_FechaNacimiento` DATE, IN `_IdNacionalidad` INT, IN `_IdSexo` INT, IN `_Telefono` VARCHAR(14), IN `_Celular` VARCHAR(14), IN `_Correo` VARCHAR(50), IN `_ModificadoPor` INT, IN `_pass` VARCHAR(191), IN `_email` VARCHAR(50), IN `_token` VARCHAR(100), IN `_IdCargo` INT, IN `_IdSucirsal` INT)  BEGIN
    	INSERT INTO personas (personas.Cedula, personas.Nombres, personas.Apellido1, personas.Apellido2, personas.FechaNacimineto,
                              personas.IdNacionalidad, personas.IdSexo, personas.Telefono,personas.Celular, personas.Correo,
                              personas.IdUser, personas.created_at)
        VALUES (_Cedula, _Nombres, _Apellido1, _Apellido2, _FechaNacimiento, _IdNacionalidad, _IdSexo, _Telefono, _Celular,
                _Correo, _ModificadoPor, TIMESTAMP(NOW()));
                
        SET @IdPersona = (SELECT personas.Idpersona
                          FROM 	personas
                          WHERE	personas.Cedula= _Cedula
                          ORDER BY personas.Idpersona DESC
                          LIMIT 1);
        SET @email = (SELECT CONCAT(SUBSTRING(personas.Nombres,1,1),personas.Apellido1)
                          	FROM 	personas
                          	WHERE	personas.Cedula= _Cedula
                          	ORDER BY personas.Idpersona DESC
                          	LIMIT 1);
        SET @emaillogin = (SELECT CONCAT(SUBSTRING(personas.Nombres,1,1),personas.Apellido1,"@laboratorioclinicodrgarcia.com")
                          	FROM 	personas
                          	WHERE	personas.Cedula= _Cedula
                          	ORDER BY personas.Idpersona DESC
                          	LIMIT 1);

        INSERT INTO users (users.IdPersona, users.name, users.password, users.email, users.IdEstado, users.remember_token,
                                   users.IdCargo, users.IdSucursal,users.created_at, users.updated_at)
                VALUES (@IdPersona, @email, _pass, @emaillogin,1, _token, _IdCargo, _IdSucirsal, TIMESTAMP(NOW()),TIMESTAMP(NOW())
                       );
            END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `INSERT_Procedimiento` (IN `_Nombre` VARCHAR(50), IN `_CostoPeso` INT, IN `_CostoDolar` INT, IN `_ModificadoPor` INT)  BEGIN
    	INSERT INTO procedimientos (procedimientos.Nombre,procedimientos.ModificadoPor,procedimientos.FechaModificacion) 
        		VALUES (_Nombre,_ModificadoPor,Now());
                
        SET @IDPROCEDIMIENTO=(SELECT procedimientos.IdProcedimiento
                              FROM procedimientos
                              WHERE procedimientos.Nombre=_NOMBRE
                              ORDER BY procedimientos.IdProcedimiento DESC LIMIT 1);
                              
        INSERT INTO costos (	costos.IdProcedimiento,costos.IdMoneda,costos.Costo,costos.ModificadoPor,costos.FechaModificacion) 
        		VALUES (@IDPROCEDIMIENTO,1,_CostoPeso,_ModificadoPor,Now());
                
		INSERT INTO costos (costos.IdProcedimiento,costos.IdMoneda,costos.Costo,costos.ModificadoPor,costos.FechaModificacion) 
        		VALUES (@IDPROCEDIMIENTO,2,_CostoDolar,_ModificadoPor,Now());                
 END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SELECT_DatosPacienteByCedula` (IN `_Cedula` VARCHAR(50))  BEGIN
        SELECT  pacientes.IdPersona as Paciente,CONCAT(personas.Nombres,' ',personas.Apellido1,' ',personas.Apellido2) AS Nombre, personas.Cedula,personas.Correo,personas.IdNacionalidad,DATE_FORMAT(personas.FechaNacimineto,"%d-%m-%Y") FechaNacimineto,
        TIMESTAMPDIFF(YEAR, personas.FechaNacimineto, CURDATE()) AS Edad,sexos.Codigo,personas.Celular, pacientes.SeguroMedico

        from    personas inner JOIN
                pacientes on pacientes.IdPersona = personas.Idpersona inner JOIN
                sexos on sexos.IdSexo=personas.IdSexo

        WHERE personas.Idpersona=_Cedula;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SELECT_FacturaByIdFactura` (IN `_IdFactura` INT)  BEGIN
    	
        SELECT	DATE_FORMAT(factura.Fecha,"%d-%m-%Y %H:%i:%s")Fecha, sucursales.Nombre as Sucursal, sucursales.Telefono,
        		concat(personas.Nombres,' ',personas.Apellido1,' ',personas.Apellido2) as Paciente,
                personas.Cedula,personas.Celular as Telefono,monedas.Simbolo as Moneda, sexos.Codigo as Sexo,
                DATE_FORMAT(personas.FechaNacimineto,"%d-%m-%Y") FechaNacimineto,
                TIMESTAMPDIFF(YEAR, personas.FechaNacimineto, CURDATE()) AS Edad,pacientes.SeguroMedico,
        		round(factura.Total,2)as Total,round(factura.Itbis,2)as Itbis,round(factura.Descuento,2)as Descuento,round(factura.TotalPagar,2)as TotalPagar,estadofactura.Nombre Estado,
                users.name AS Usuario
        FROM	factura INNER JOIN
        		sucursales on sucursales.IdSucursal=factura.IdSucursal INNER JOIN
        		pacientes on pacientes.IdPaciente=factura.IdPaciente INNER JOIN
                personas on personas.Idpersona=pacientes.IdPersona INNER JOIN
                sexos on sexos.IdSexo=personas.IdSexo INNER JOIN
                monedas on monedas.IdMoneda=factura.IdMoneda INNER JOIN
                estadofactura on estadofactura.IdEstadoFactura=factura.IdEstadoFactura INNER JOIN
                users ON users.IdUser=factura.ModificadoPor
        WHERE	factura.IdFactura=_IdFactura;
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SELECT_FacturaDetallesByIdFactura` (IN `_IdFactura` INT)  BEGIN
    	SELECT	 procedimientos.IdProcedimiento,procedimientos.Nombre as Procedimiento, monedas.Simbolo as Moneda, costos.Costo
        FROM	detallefactura INNER JOIN
                procedimientos ON procedimientos.IdProcedimiento=detallefactura.IdProcedimiento INNER JOIN
                costos ON costos.IdProcedimiento=procedimientos.IdProcedimiento INNER JOIN
                factura on factura.IdFactura=detallefactura.IdFactura INNER JOIN
              	monedas on monedas.IdMoneda=factura.IdMoneda and monedas.IdMoneda=costos.IdMoneda 
        WHERE	detallefactura.IdFactura=_IdFactura;
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SELECT_Facturas` (IN `_IdFactura` INT, `_IdSucursal` INT)  BEGIN

SELECT	factura.IdFactura, DATE_FORMAT(factura.Fecha,"%d-%m-%Y") Fecha, concat(personas.Nombres,' ',personas.Apellido1,' ',personas.Apellido2) Paciente,
		sucursales.Nombre Sucursal, monedas.Simbolo, round(factura.TotalPagar,2)Total,estadofactura.Nombre Estado 
 FROM	factura inner JOIN
 		pacientes on pacientes.IdPaciente = factura.IdPaciente INNER JOIN
        personas on personas.Idpersona = pacientes.IdPaciente inner JOIN
        sucursales on sucursales.IdSucursal = factura.IdSucursal inner JOIN
        monedas on monedas.IdMoneda = factura.IdMoneda inner JOIN
        estadofactura on estadofactura.IdEstadoFactura=factura.IdEstadoFactura
WHERE	factura.IdFactura = _IdFactura OR factura.IdSucursal in (_IdSucursal);

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SELECT_FiltroPaciente` ()  BEGIN
SELECT concat(personas.Nombres,' ',personas.Apellido1,' ',personas.Apellido2,
                      ' (',personas.Cedula,')')as Paciente,personas.Idpersona

       FROM	pacientes inner JOIN
               personas on personas.Idpersona = pacientes.IdPersona; 
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SELECT_GanaciasByFechaMonedaSucursal` (IN `_Moneda` INT, IN `_Sucursal` INT, IN `_FechaDesde` DATE, IN `_FechaHasta` DATE)  BEGIN
    SELECT 		factura.Fecha, users.name Caja,sucursales.Nombre Sucursal,factura.IdFactura, procedimientos.Nombre Procedimiento,monedas.Simbolo, costos.Costo 
    FROM 		factura inner JOIN
                detallefactura on detallefactura.IdFactura=factura.IdFactura INNER JOIN
                procedimientos on procedimientos.IdProcedimiento=detallefactura.IdProcedimiento inner JOIN
                monedas ON monedas.IdMoneda = factura.IdMoneda INNER JOIN
                costos ON costos.IdMoneda = monedas.IdMoneda  and costos.IdProcedimiento=procedimientos.IdProcedimiento inner JOIN
                users ON users.IdUser = factura.ModificadoPor INNER JOIN
                sucursales on sucursales.IdSucursal = factura.IdSucursal
    WHERE		factura.IdMoneda =_Moneda and factura.IdEstadoFactura=1 and ((substring(cast(factura.Fecha AS CHAR),1,10)) BETWEEN _FechaDesde and _FechaHasta) and factura.IdSucursal in (_Sucursal)  
    order by 	factura.Fecha, factura.IdFactura,factura.IdSucursal ASC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SELECT_HistorialPacienteByCedula` (IN `_Cedula` VARCHAR(50))  BEGIN
    	SELECT	historial.Fecha,concat(personas.Nombres,' ',personas.Apellido1,' ',personas.Apellido2) AS Paciente, procedimientos.Nombre as Procedimiento,
        		CONCAT(P2.Nombres+' '+P2.Apellido1,'',P2.Apellido2) AS Doctor, sucursales.Codigo as Sucursal
        FROM	historial INNER JOIN
        		pacientes ON historial.IdPaciente=pacientes.IdPaciente INNER JOIN
                personas ON personas.Idpersona=pacientes.IdPersona INNER JOIN
                procedimientos on procedimientos.IdProcedimiento=historial.IdProcedimiento INNER JOIN
                doctores ON historial.IdDoctor=doctores.IdDoctor INNER JOIN
                personas as P2 on P2.Idpersona=doctores.IdPersona INNER JOIN
                sucursales on sucursales.IdSucursal=historial.IdSucursal
        WHERE	(personas.Cedula=_Cedula)
        ORDER BY historial.Fecha DESC;
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SELECT_HistorialPacientesByFecha` (IN `_FechaInicio` VARCHAR(20), IN `_FechaFin` VARCHAR(20))  BEGIN
        SELECT 	historial.Fecha,personas.Nombres+' '+personas.Apellidos AS Paciente, procedimientos.Nombre as Procedimiento,
        		P2.Nombres+' '+P2.Apellidos AS Doctor, sucursales.Codigo as Sucursal
        FROM 	historial INNER JOIN 
                pacientes ON historial.IdPaciente=pacientes.IdPaciente INNER JOIN 
                personas ON personas.Idpersona=pacientes.IdPersona INNER JOIN 
                procedimientos on procedimientos.IdProcedimiento=historial.IdProcedimiento INNER JOIN 
                doctores ON historial.IdDoctor=doctores.IdDoctor INNER JOIN 
                personas as P2 on P2.Idpersona=doctores.IdPersona INNER JOIN 
                sucursales on sucursales.IdSucursal=historial.IdSucursal INNER JOIN 
                users on users.IdUser=doctores.IdUsuario 
        WHERE 	((substring(cast(historial.Fecha AS CHAR),1,10))BETWEEN _FechaInicio and _FechaFin) 
        ORDER BY historial.Fecha DESC; 
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SELECT_HistorialPacientesByIdSucursal` (IN `_IdSucursal` INT)  BEGIN
    	SELECT	historial.Fecha,personas.Nombres+' '+personas.Apellidos AS Paciente, procedimientos.Nombre as Procedimiento,
        		P2.Nombres+' '+P2.Apellidos AS Doctor, sucursales.Codigo as Sucursal
        FROM	historial INNER JOIN
        		pacientes ON historial.IdPaciente=pacientes.IdPaciente INNER JOIN
                personas ON personas.Idpersona=pacientes.IdPersona INNER JOIN
                procedimientos on procedimientos.IdProcedimiento=historial.IdProcedimiento INNER JOIN
                doctores ON historial.IdDoctor=doctores.IdDoctor INNER JOIN
                personas as P2 on P2.Idpersona=doctores.IdPersona INNER JOIN
                sucursales on sucursales.IdSucursal=historial.IdSucursal
        WHERE	(historial.IdSucursal=_IdSucursal)
        ORDER BY historial.Fecha DESC;
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SELECT_HistorialPacientesByUsuarioDoctor` (IN `_Usuario` VARCHAR(50))  BEGIN
    	SELECT	historial.Fecha,personas.Nombres+' '+personas.Apellidos AS Paciente, procedimientos.Nombre as Procedimiento,
        		P2.Nombres+' '+P2.Apellidos AS Doctor, sucursales.Codigo as Sucursal
        FROM	historial INNER JOIN
        		pacientes ON historial.IdPaciente=pacientes.IdPaciente INNER JOIN
                personas ON personas.Idpersona=pacientes.IdPersona INNER JOIN
                procedimientos on procedimientos.IdProcedimiento=historial.IdProcedimiento INNER JOIN
                doctores ON historial.IdDoctor=doctores.IdDoctor INNER JOIN
                personas as P2 on P2.Idpersona=doctores.IdPersona INNER JOIN
                sucursales on sucursales.IdSucursal=historial.IdSucursal INNER JOIN
                users on users.IdUser=doctores.IdUsuario
        WHERE	(users.name=_Usuario)
        ORDER BY historial.Fecha DESC;
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SELECT_IngresosMensuales` ()  BEGIN
    SELECT 		DATE_FORMAT(factura.Fecha,"%M-%Y"), ROUND(SUM(factura.TotalPagar),2)
    FROM 		factura 
    WHERE		factura.Fecha BETWEEN DATE_ADD(NOW(), INTERVAL -1 YEAR) AND NOW()
    GROUP BY 	DATE_FORMAT(factura.Fecha,"%M-%Y");
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SELECT_IngresosUltimoMesBySucursal` (IN `_Sucursal` INT)  BEGIN
        select 	 	sucursales.Nombre sucursales,ROUND(SUM(factura.TotalPagar),2)Cantidad
        FROM		factura inner JOIN
        			sucursales on sucursales.IdSucursal=factura.IdSucursal
        WHERE		(factura.Fecha BETWEEN DATE_ADD(now(), INTERVAL -30 DAY) AND NOW()) AND factura.IdSucursal in(_Sucursal)
        group by 	sucursales.Nombre;
		
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SELECT_Pacientes` ()  BEGIN
SELECT		personas.Idpersona,personas.Cedula, personas.Nombres, concat(personas.Apellido1,' ',personas.Apellido2)Apellidos,
			date_format(personas.FechaNacimineto, "%d-%m-%Y") FechaNacimiento, nacionalidades.Nombre Nacionalidad,
           	sexos.Codigo Sexo, personas.Telefono, personas.Celular, pacientes.SeguroMedico
FROM		pacientes inner JOIN
			personas on personas.Idpersona=pacientes.IdPersona inner JOIN
            nacionalidades on nacionalidades.IdNacionalidades = personas.IdNacionalidad INNER JOIN
            sexos on sexos.IdSexo=personas.IdSexo;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SELECT_PacientesDatosByCedula` (IN `_Cedula` VARCHAR(50))  BEGIN
    	SELECT	P.Cedula,P.Nombres,P.Apellidos,S.Codigo AS Sexo, N.Nombre AS Nacionalidad, P.Telefono, P.Celular, P.Correo, P.FechaNacimiento
        FROM	personas P INNER JOIN
        		pacientes PA ON PA.IdPersona=P.IdPersona INNER JOIN
                nacionalidades N ON N.IdNacionalidades=P.IdNacionalidad INNER JOIN
                sexos S on s.IdSexo=p.IdSexo
        WHERE	P.Cedula=(_Cedula);
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SELECT_PersonaEmpleado` (IN `_IdPersona` INT)  BEGIN
 		SELECT		personas.Cedula,
                    personas.Nombres,
                    personas.Apellido1,
                    personas.Apellido2,
                    personas.FechaNacimineto,
                    personas.IdNacionalidad,
                    personas.IdSexo,
                    personas.Telefono,
                    personas.Celular,
                    personas.Correo,
                    users.IdSucursal,
                    users.IdCargo
        FROM		personas inner JOIN
                    users on users.IdPersona = personas.Idpersona
        WHERE		personas.Idpersona=_IdPersona;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SELECT_PersonaPaciente` (IN `_IdPersona` INT)  BEGIN
 		SELECT		personas.Cedula,
                    personas.Nombres,
                    personas.Apellido1,
                    personas.Apellido2,
                    personas.FechaNacimineto,
                    personas.IdNacionalidad,
                    personas.IdSexo,
                    personas.Telefono,
                    personas.Celular,
                    personas.Correo,
                    pacientes.SeguroMedico
        FROM		personas inner JOIN
                    pacientes on pacientes.IdPersona = personas.Idpersona
        WHERE		personas.Idpersona=_IdPersona;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SELECT_Procedimientos` ()  BEGIN
        SELECT		procedimientos.IdProcedimiento Codigo, procedimientos.Nombre Procedimiento, costos.Costo 'RD$',
        			c.Costo as 'US$'
        FROM		procedimientos INNER JOIN
                    costos on costos.IdProcedimiento=procedimientos.IdProcedimiento INNER JOIN
                    costos as c on procedimientos.IdProcedimiento=c.IdProcedimiento
        WHERE		costos.IdMoneda=1 and c.IdMoneda=2
        ORDER BY	procedimientos.IdProcedimiento ASC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SELECT_ProcedimientosByMoneda` ()  BEGIN
        SELECT procedimientos.Nombre AS Procedimiento, monedas.Nombre AS Moneda, costos.Costo
        FROM procedimientos  INNER JOIN
        costos ON procedimientos.IdProcedimiento=costos.IdProcedimiento INNER JOIN
        monedas ON monedas.IdMoneda=costos.IdMoneda;
    END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SELECT_ProcedimientosMasRealizadosUltimoMes` ()  BEGIN
        select 	 	procedimientos.Nombre procedimiento,COUNT(procedimientos.IdProcedimiento)Cantidad
        FROM		factura inner JOIN
                    detallefactura on detallefactura.IdFactura=factura.IdFactura inner JOIN
                    procedimientos on procedimientos.IdProcedimiento=detallefactura.IdProcedimiento
        WHERE		factura.Fecha BETWEEN DATE_ADD(now(), INTERVAL -30 DAY) AND NOW()
        group by 	procedimientos.Nombre;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SELECT_ProcedimientosMasRealizadosUltimoMesPorSucursal` (IN `_Sucursal` INT)  BEGIN
        select 	 	procedimientos.Nombre procedimiento,COUNT(procedimientos.IdProcedimiento)Cantidad
        FROM		factura inner JOIN
                    detallefactura on detallefactura.IdFactura=factura.IdFactura inner JOIN
                    procedimientos on procedimientos.IdProcedimiento=detallefactura.IdProcedimiento
        WHERE		(factura.Fecha BETWEEN DATE_ADD(now(), INTERVAL -30 DAY) AND NOW()) AND factura.IdSucursal=_Sucursal
        group by 	procedimientos.Nombre;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SELECT_Usuarios` ()  BEGIN
		SELECT 		users.IdPersona, concat(personas.Nombres,' ',personas.Apellido1,' ',personas.Apellido2)Nombre,personas.Cedula, users.name Usuario,users.password Contraseña, estados.Nombre Estado 
        FROM		users inner JOIN
                    personas on personas.Idpersona=users.IdPersona inner JOIN
                    estados on estados.IdEstado=users.IdEstado
        ORDER BY	users.IdPersona;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UPDATE_ContraseñaUsuarios` (IN `_Pass` VARCHAR(191), `_name` VARCHAR(50))  BEGIN
        UPDATE 	users 
        SET 	users.password= _Pass
        WHERE 	users.name=_name;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UPDATE_FacturaEstado` (IN `_IdEstadoFactura` INT, `_ModificadoPor` INT, `_IdFactura` INT)  BEGIN

UPDATE 	factura 
SET		factura.IdEstadoFactura = _IdEstadoFactura, factura.ModificadoPor=_ModificadoPor
WHERE	factura.IdFactura =_IdFactura;

INSERT INTO hitorialfactura (hitorialfactura.IdFactura, 
                                     hitorialfactura.IdPaciente, 
                                     hitorialfactura.Fecha, 
                                     hitorialfactura.IdMoneda,
                                     hitorialfactura.IdTipoPago,
                                     hitorialfactura.Total, 
                                     hitorialfactura.Descuento,
                                     hitorialfactura.Itbis,
                                     hitorialfactura.TotalPagar,
                                     hitorialfactura.IdEstadoFactura,
                                     hitorialfactura.ModificadoPor,
                                     hitorialfactura.FechaModificacion)

SELECT 	factura.IdFactura,factura.IdPaciente,factura.Fecha,factura.IdMoneda,factura.IdTipoPago,
        factura.Total,factura.Descuento,factura.Itbis,factura.TotalPagar,factura.IdEstadoFactura,
        factura.ModificadoPor, now()
FROM	factura
WHERE	factura.IdFactura=_IdFactura;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UPDATE_PersonaEmpleado` (IN `_Cedula` VARCHAR(50), `_Nombre` VARCHAR(40), `_Apellido1` VARCHAR(40), `_Apellido2` VARCHAR(40), `_Nacimiento` DATETIME, `_IdNacionalidad` INT, `_IdSexo` INT, `_Telefono` VARCHAR(14), `_Celular` VARCHAR(14), `_Correo` VARCHAR(50), `_IdPersona` INT, `_IdSucursal` INT, `_IdCargo` INT)  BEGIN
		UPDATE 		personas
        SET			personas.Cedula=_Cedula, 
                    personas.Nombres=_Nombre, 
                    personas.Apellido1=_Apellido1,
                    personas.Apellido2=_Apellido2, 
                    personas.FechaNacimineto=_Nacimiento,
                    personas.IdNacionalidad= _IdNacionalidad,
                    personas.IdSexo= _IdSexo,
                    personas.Telefono= _Telefono,
                    personas.Celular= _Celular,
                    personas.Correo= _Correo,
                    personas.updated_at= Now()
        WHERE		personas.Idpersona= _IdPersona;


        UPDATE 		users
        SET			users.IdSucursal=_IdSucursal,
                    users.IdCargo= _IdCargo,
                    users.updated_at= NOW()
        WHERE		users.IdPersona= _IdPersona;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UPDATE_PersonaPaciente` (IN `_Cedula` VARCHAR(50), `_Nombre` VARCHAR(40), `_Apellido1` VARCHAR(40), `_Apellido2` VARCHAR(40), `_Nacimiento` DATETIME, `_IdNacionalidad` INT, `_IdSexo` INT, `_Telefono` VARCHAR(14), `_Celular` VARCHAR(14), `_Correo` VARCHAR(50), `_SeguroMedico` VARCHAR(50), `_IdPersona` INT)  BEGIN
        UPDATE 		personas
        SET			personas.Cedula=_Cedula, 
                    personas.Nombres=_Nombre, 
                    personas.Apellido1=_Apellido1,
                    personas.Apellido2=_Apellido2, 
                    personas.FechaNacimineto=_Nacimiento,
                    personas.IdNacionalidad= _IdNacionalidad,
                    personas.IdSexo= _IdSexo,
                    personas.Telefono= _Telefono,
                    personas.Celular= _Celular,
                    personas.Correo= _Correo,
                    personas.updated_at= Now()
        WHERE		personas.Idpersona= _IdPersona;
        
        UPDATE		pacientes
        SET			pacientes.SeguroMedico= _SeguroMedico
        WHERE		pacientes.IdPersona=_IdPersona;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UPDATE_Procedimiento` (IN `_Nombre` VARCHAR(50), `_CostoPeso` INT, `_CostoDolar` INT, `_IdProcedimiento` INT, `_ModificadoPor` INT)  BEGIN
    	UPDATE 	procedimientos 
        SET 	procedimientos.Nombre=_Nombre, procedimientos.ModificadoPor=_ModificadoPor,
        		procedimientos.FechaModificacion=Now()
        WHERE	procedimientos.IdProcedimiento=_IdProcedimiento;
        
        UPDATE	costos
        SET		costos.Costo=_CostoPeso, costos.ModificadoPor=_ModificadoPor, costos.FechaModificacion=Now()
        WHERE	costos.IdMoneda=1 AND costos.IdProcedimiento=_IdProcedimiento;
        
        UPDATE	costos
        SET		costos.Costo=_CostoDolar, costos.ModificadoPor=_ModificadoPor, costos.FechaModificacion=Now()
        WHERE	costos.IdMoneda=2 AND costos.IdProcedimiento=_IdProcedimiento;
    END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cargos`
--

CREATE TABLE `cargos` (
  `IdCargo` int(11) NOT NULL,
  `Nombre` varchar(50) DEFAULT NULL,
  `IdRol` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `cargos`
--

INSERT INTO `cargos` (`IdCargo`, `Nombre`, `IdRol`) VALUES
(1, 'Admin/Doctor', 1),
(2, 'Secretaria', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `costos`
--

CREATE TABLE `costos` (
  `IdProcedimiento` int(11) NOT NULL,
  `IdMoneda` int(11) NOT NULL,
  `Costo` int(11) NOT NULL,
  `ModificadoPor` int(11) NOT NULL,
  `FechaModificacion` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `costos`
--

INSERT INTO `costos` (`IdProcedimiento`, `IdMoneda`, `Costo`, `ModificadoPor`, `FechaModificacion`) VALUES
(1, 1, 1, 1, '2017-09-20 20:29:08'),
(2, 1, 2, 2, '2017-09-20 20:37:59'),
(3, 1, 3, 3, '2017-09-20 21:47:26'),
(4, 1, 4, 312, '2017-09-20 21:49:10'),
(5, 1, 4, 312, '2017-09-20 21:51:58'),
(6, 1, 234, 1, '2017-09-21 00:54:09'),
(7, 1, 456, 1, '2017-09-21 01:10:37'),
(8, 1, 1000, 1, '2017-09-21 01:11:50'),
(9, 1, 3322, 1, '2017-09-21 16:39:57'),
(9, 2, 23, 1, '2017-09-21 16:39:57'),
(10, 1, 1000, 1, '2017-10-03 11:15:56'),
(10, 2, 22, 1, '2017-10-03 11:15:56'),
(11, 1, 600, 1, '2017-09-21 16:48:45'),
(11, 2, 600, 1, '2017-09-21 16:48:45'),
(12, 1, 500, 4, '2017-09-21 22:26:57'),
(12, 2, 40, 4, '2017-09-21 22:26:57'),
(13, 1, 300, 10, '2017-09-21 23:11:14'),
(13, 2, 15, 10, '2017-09-21 23:11:14'),
(14, 1, 250, 1, '2017-10-30 11:42:08'),
(14, 2, 25, 1, '2017-10-30 11:42:08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detallefactura`
--

CREATE TABLE `detallefactura` (
  `IdDetalleFactura` int(11) NOT NULL,
  `IdFactura` int(11) NOT NULL,
  `IdProcedimiento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detallefactura`
--

INSERT INTO `detallefactura` (`IdDetalleFactura`, `IdFactura`, `IdProcedimiento`) VALUES
(1, 4, 5),
(2, 4, 10),
(3, 5, 3),
(4, 5, 11),
(5, 6, 5),
(6, 6, 9),
(7, 6, 11),
(8, 7, 10),
(9, 7, 13),
(10, 7, 5),
(11, 8, 4),
(12, 8, 5),
(13, 9, 6),
(14, 9, 14),
(15, 10, 3),
(16, 11, 14),
(17, 11, 12),
(18, 12, 4),
(19, 12, 14),
(20, 13, 2),
(21, 13, 11),
(22, 13, 14),
(23, 14, 3),
(24, 14, 12),
(25, 14, 14),
(26, 15, 2),
(27, 15, 3),
(28, 15, 12),
(29, 16, 5),
(30, 16, 13),
(31, 16, 8),
(32, 17, 5),
(33, 17, 9),
(34, 18, 2),
(35, 18, 4),
(36, 18, 13),
(37, 19, 2),
(38, 19, 11),
(39, 19, 14),
(40, 20, 2),
(41, 21, 2),
(42, 21, 4),
(43, 21, 12),
(44, 36, 11),
(45, 36, 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `doctores`
--

CREATE TABLE `doctores` (
  `IdDoctor` int(11) NOT NULL,
  `IdPersona` int(11) NOT NULL,
  `IdUsuario` int(11) DEFAULT NULL,
  `Estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estadofactura`
--

CREATE TABLE `estadofactura` (
  `IdEstadoFactura` int(11) NOT NULL,
  `Nombre` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estadofactura`
--

INSERT INTO `estadofactura` (`IdEstadoFactura`, `Nombre`) VALUES
(0, 'Cancelada'),
(1, 'Activa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados`
--

CREATE TABLE `estados` (
  `IdEstado` int(11) NOT NULL,
  `Nombre` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estados`
--

INSERT INTO `estados` (`IdEstado`, `Nombre`) VALUES
(0, 'Inactivo'),
(1, 'Activo');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `IdFactura` int(11) NOT NULL,
  `IdPaciente` int(11) NOT NULL,
  `IdSucursal` int(11) NOT NULL,
  `Fecha` datetime NOT NULL,
  `IdMoneda` int(11) NOT NULL,
  `IdTipoPago` int(11) NOT NULL,
  `Total` double NOT NULL,
  `Descuento` double DEFAULT NULL,
  `Itbis` double DEFAULT NULL,
  `TotalPagar` double NOT NULL,
  `IdEstadoFactura` int(11) NOT NULL,
  `ModificadoPor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `factura`
--

INSERT INTO `factura` (`IdFactura`, `IdPaciente`, `IdSucursal`, `Fecha`, `IdMoneda`, `IdTipoPago`, `Total`, `Descuento`, `Itbis`, `TotalPagar`, `IdEstadoFactura`, `ModificadoPor`) VALUES
(1, 8, 1, '2017-10-12 08:21:41', 1, 2, 6, 0.06, 1.0692, 7.0092, 0, 11),
(2, 8, 2, '2017-10-12 08:23:14', 1, 2, 5, 0.05, 0.891, 5.841, 1, 19),
(3, 8, 1, '2017-10-12 08:24:40', 1, 2, 237, 2.37, 42.233399999999996, 276.8634, 1, 11),
(4, 8, 2, '2017-10-13 07:50:53', 1, 2, 1004, 10.040000000000001, 178.9128, 1172.8728, 1, 1),
(5, 8, 1, '2017-10-13 08:13:33', 1, 2, 603, 6.03, 107.4546, 704.4246, 1, 11),
(6, 8, 2, '2017-10-13 08:19:23', 1, 2, 3926, 196.3, 671.3459999999999, 4401.045999999999, 1, 1),
(7, 8, 1, '2017-10-13 08:21:49', 1, 2, 1304, 13.040000000000001, 232.37279999999998, 1523.3328000000001, 1, 11),
(8, 8, 2, '2017-10-13 08:25:19', 1, 2, 8, 0.08, 1.4256, 9.3456, 1, 1),
(9, 8, 1, '2017-10-27 07:59:15', 1, 2, 484, 4.84, 86.2488, 565.4088, 1, 11),
(10, 1, 1, '2017-10-28 22:10:46', 1, 2, 0, 0.12, 0.5184, 3.3983999999999996, 1, 11),
(11, 8, 1, '2017-10-29 10:48:06', 2, 2, 0, 0, 8.1, 53.1, 0, 11),
(12, 8, 0, '2017-10-30 08:05:16', 1, 2, 0, 25.400000000000002, 41.147999999999996, 269.748, 1, 11),
(13, 8, 0, '2017-11-03 08:59:43', 1, 2, 0, 25.56, 148.7592, 975.1992, 1, 13),
(14, 1, 0, '2017-11-03 09:23:55', 1, 2, 0, 22.59, 131.47379999999998, 861.8838, 1, 13),
(15, 8, 0, '2017-11-03 09:25:29', 1, 2, 0, 30.299999999999997, 85.446, 560.146, 1, 13),
(16, 8, 0, '2017-11-03 09:28:08', 1, 2, 0, 39.12, 227.6784, 1492.5584000000001, 1, 13),
(17, 8, 0, '2017-11-03 09:30:29', 1, 2, 0, 99.78, 580.7195999999999, 3806.9395999999997, 1, 13),
(18, 8, 0, '2017-11-03 09:59:58', 1, 2, 0, 9.18, 53.4276, 350.2476, 1, 13),
(19, 8, 0, '2017-11-03 10:02:37', 1, 2, 0, 17.04, 150.2928, 985.2528, 1, 13),
(20, 8, 0, '2017-11-03 10:04:00', 1, 2, 0, 0.04, 0.3528, 2.3128, 1, 13),
(21, 8, 0, '2017-11-03 10:10:54', 1, 2, 0, 0, 91.08, 597.08, 1, 13),
(22, 1, 0, '2017-11-03 10:13:52', 1, 2, 0, 0, 0, 0, 1, 13),
(23, 1, 0, '2017-11-03 10:14:11', 1, 2, 0, 0, 0, 0, 1, 13),
(24, 1, 0, '2017-11-03 10:15:19', 1, 2, 0, 0, 0, 0, 1, 13),
(25, 1, 0, '2017-11-03 10:15:31', 1, 2, 0, 0, 0, 0, 1, 13),
(26, 1, 0, '2017-11-03 10:15:59', 1, 2, 0, 0, 0, 0, 1, 13),
(27, 1, 0, '2017-11-03 10:19:46', 1, 2, 0, 0, 0, 0, 1, 13),
(28, 1, 0, '2017-11-03 10:20:40', 1, 2, 0, 0, 0, 0, 1, 13),
(29, 1, 0, '2017-11-03 10:21:02', 1, 2, 0, 0, 0, 0, 1, 13),
(30, 1, 0, '2017-11-03 10:24:58', 1, 2, 0, 0, 0, 0, 1, 13),
(31, 1, 0, '2017-11-03 10:26:09', 1, 2, 0, 0, 0, 0, 1, 13),
(32, 1, 0, '2017-11-03 10:26:18', 1, 2, 0, 0, 0, 0, 1, 13),
(33, 1, 0, '2017-11-03 10:26:43', 1, 2, 0, 0, 0, 0, 1, 13),
(34, 1, 0, '2017-11-03 10:28:09', 1, 2, 0, 0, 0, 0, 1, 13),
(35, 1, 0, '2017-11-03 10:28:47', 1, 2, 0, 0, 0, 0, 1, 13),
(36, 8, 0, '2017-11-03 10:31:56', 1, 2, 0, 18, 158.76, 1040.76, 1, 13);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial`
--

CREATE TABLE `historial` (
  `IdHistorial` int(11) NOT NULL,
  `IdPaciente` int(11) NOT NULL,
  `IdProcedimiento` int(11) DEFAULT NULL,
  `Diagnostico` longtext,
  `IdSucursal` int(11) DEFAULT NULL,
  `IdDoctor` int(11) DEFAULT NULL,
  `Fecha` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `hitorialfactura`
--

CREATE TABLE `hitorialfactura` (
  `IdDetalleFactura` int(11) NOT NULL,
  `IdFactura` int(11) NOT NULL,
  `IdPaciente` int(11) NOT NULL,
  `Fecha` datetime NOT NULL,
  `IdMoneda` int(11) NOT NULL,
  `IdTipoPago` int(11) NOT NULL,
  `Total` double NOT NULL,
  `Descuento` double NOT NULL,
  `Itbis` double NOT NULL,
  `TotalPagar` double NOT NULL,
  `IdEstadoFactura` int(11) NOT NULL,
  `ModificadoPor` int(11) NOT NULL,
  `FechaModificacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `hitorialfactura`
--

INSERT INTO `hitorialfactura` (`IdDetalleFactura`, `IdFactura`, `IdPaciente`, `Fecha`, `IdMoneda`, `IdTipoPago`, `Total`, `Descuento`, `Itbis`, `TotalPagar`, `IdEstadoFactura`, `ModificadoPor`, `FechaModificacion`) VALUES
(1, 3, 8, '2017-10-12 08:24:40', 1, 2, 237, 2.37, 42.233399999999996, 276.8634, 1, 19, '2017-10-12 08:24:40'),
(2, 4, 8, '2017-10-13 07:50:53', 1, 2, 1004, 10.040000000000001, 178.9128, 1172.8728, 1, 0, '2017-10-13 07:50:53'),
(3, 5, 8, '2017-10-13 08:13:33', 1, 2, 603, 6.03, 107.4546, 704.4246, 1, 0, '2017-10-13 08:13:33'),
(4, 6, 8, '2017-10-13 08:19:23', 1, 2, 3926, 196.3, 671.3459999999999, 4401.045999999999, 1, 1, '2017-10-13 08:19:23'),
(5, 7, 8, '2017-10-13 08:21:49', 1, 2, 1304, 13.040000000000001, 232.37279999999998, 1523.3328000000001, 1, 1, '2017-10-13 08:21:49'),
(6, 8, 8, '2017-10-13 08:25:19', 1, 2, 8, 0.08, 1.4256, 9.3456, 1, 1, '2017-10-13 08:25:19'),
(7, 9, 8, '2017-10-27 07:59:15', 1, 2, 484, 4.84, 86.2488, 565.4088, 1, 1, '2017-10-27 07:59:15'),
(8, 10, 1, '2017-10-28 22:10:46', 1, 2, 0, 0.12, 0.5184, 3.3983999999999996, 1, 1, '2017-10-28 22:10:46'),
(9, 11, 8, '2017-10-29 10:48:06', 2, 2, 0, 0, 8.1, 53.1, 1, 1, '2017-10-29 10:48:06'),
(10, 9, 8, '2017-10-27 07:59:15', 1, 2, 484, 4.84, 86.2488, 565.4088, 0, 11, '2017-10-29 22:45:57'),
(11, 9, 8, '2017-10-27 07:59:15', 1, 2, 484, 4.84, 86.2488, 565.4088, 1, 11, '2017-10-29 22:48:06'),
(12, 10, 1, '2017-10-28 22:10:46', 1, 2, 0, 0.12, 0.5184, 3.3983999999999996, 1, 11, '2017-10-29 23:11:14'),
(13, 7, 8, '2017-10-13 08:21:49', 1, 2, 1304, 13.040000000000001, 232.37279999999998, 1523.3328000000001, 0, 11, '2017-10-29 23:11:23'),
(14, 7, 8, '2017-10-13 08:21:49', 1, 2, 1304, 13.040000000000001, 232.37279999999998, 1523.3328000000001, 1, 11, '2017-10-29 23:11:36'),
(15, 10, 1, '2017-10-28 22:10:46', 1, 2, 0, 0.12, 0.5184, 3.3983999999999996, 0, 11, '2017-10-29 23:11:52'),
(16, 1, 8, '2017-10-12 08:21:41', 1, 2, 6, 0.06, 1.0692, 7.0092, 0, 11, '2017-10-29 23:11:58'),
(17, 10, 1, '2017-10-28 22:10:46', 1, 2, 0, 0.12, 0.5184, 3.3983999999999996, 1, 11, '2017-10-29 23:13:21'),
(18, 5, 8, '2017-10-13 08:13:33', 1, 2, 603, 6.03, 107.4546, 704.4246, 0, 11, '2017-10-29 23:18:09'),
(19, 5, 8, '2017-10-13 08:13:33', 1, 2, 603, 6.03, 107.4546, 704.4246, 1, 11, '2017-10-29 23:18:28'),
(20, 1, 8, '2017-10-12 08:21:41', 1, 2, 6, 0.06, 1.0692, 7.0092, 1, 11, '2017-10-30 07:12:58'),
(21, 1, 8, '2017-10-12 08:21:41', 1, 2, 6, 0.06, 1.0692, 7.0092, 0, 11, '2017-10-30 07:13:00'),
(22, 1, 8, '2017-10-12 08:21:41', 1, 2, 6, 0.06, 1.0692, 7.0092, 1, 11, '2017-10-30 07:13:04'),
(23, 1, 8, '2017-10-12 08:21:41', 1, 2, 6, 0.06, 1.0692, 7.0092, 0, 11, '2017-10-30 07:13:05'),
(24, 1, 8, '2017-10-12 08:21:41', 1, 2, 6, 0.06, 1.0692, 7.0092, 1, 11, '2017-10-30 07:22:57'),
(25, 1, 8, '2017-10-12 08:21:41', 1, 2, 6, 0.06, 1.0692, 7.0092, 0, 11, '2017-10-30 07:22:59'),
(26, 1, 8, '2017-10-12 08:21:41', 1, 2, 6, 0.06, 1.0692, 7.0092, 1, 11, '2017-10-30 07:23:01'),
(27, 1, 8, '2017-10-12 08:21:41', 1, 2, 6, 0.06, 1.0692, 7.0092, 0, 11, '2017-10-30 07:26:46'),
(28, 1, 8, '2017-10-12 08:21:41', 1, 2, 6, 0.06, 1.0692, 7.0092, 1, 11, '2017-10-30 07:32:35'),
(29, 11, 8, '2017-10-29 10:48:06', 2, 2, 0, 0, 8.1, 53.1, 0, 11, '2017-10-30 07:33:32'),
(30, 1, 8, '2017-10-12 08:21:41', 1, 2, 6, 0.06, 1.0692, 7.0092, 0, 11, '2017-10-30 07:36:05'),
(31, 3, 8, '2017-10-12 08:24:40', 1, 2, 237, 2.37, 42.233399999999996, 276.8634, 0, 11, '2017-10-30 07:36:14'),
(32, 1, 8, '2017-10-12 08:21:41', 1, 2, 6, 0.06, 1.0692, 7.0092, 1, 11, '2017-10-30 07:37:51'),
(33, 1, 8, '2017-10-12 08:21:41', 1, 2, 6, 0.06, 1.0692, 7.0092, 0, 11, '2017-10-30 07:37:54'),
(34, 12, 8, '2017-10-30 08:05:16', 1, 2, 0, 25.400000000000002, 41.147999999999996, 269.748, 1, 11, '2017-10-30 08:05:16'),
(35, 3, 8, '2017-10-12 08:24:40', 1, 2, 237, 2.37, 42.233399999999996, 276.8634, 1, 11, '2017-10-30 08:16:18'),
(36, 1, 8, '2017-10-12 08:21:41', 1, 2, 6, 0.06, 1.0692, 7.0092, 1, 11, '2017-10-30 08:16:38'),
(37, 1, 8, '2017-10-12 08:21:41', 1, 2, 6, 0.06, 1.0692, 7.0092, 0, 11, '2017-10-30 08:16:42'),
(38, 13, 8, '2017-11-03 08:59:43', 1, 2, 0, 25.56, 148.7592, 975.1992, 1, 13, '2017-11-03 08:59:43'),
(39, 14, 1, '2017-11-03 09:23:55', 1, 2, 0, 22.59, 131.47379999999998, 861.8838, 1, 13, '2017-11-03 09:23:55'),
(40, 15, 8, '2017-11-03 09:25:29', 1, 2, 0, 30.299999999999997, 85.446, 560.146, 1, 13, '2017-11-03 09:25:29'),
(41, 16, 8, '2017-11-03 09:28:08', 1, 2, 0, 39.12, 227.6784, 1492.5584000000001, 1, 13, '2017-11-03 09:28:08'),
(42, 17, 8, '2017-11-03 09:30:29', 1, 2, 0, 99.78, 580.7195999999999, 3806.9395999999997, 1, 13, '2017-11-03 09:30:29'),
(43, 18, 8, '2017-11-03 09:59:58', 1, 2, 0, 9.18, 53.4276, 350.2476, 1, 13, '2017-11-03 09:59:58'),
(44, 19, 8, '2017-11-03 10:02:37', 1, 2, 0, 17.04, 150.2928, 985.2528, 1, 13, '2017-11-03 10:02:37'),
(45, 20, 8, '2017-11-03 10:04:00', 1, 2, 0, 0.04, 0.3528, 2.3128, 1, 13, '2017-11-03 10:04:00'),
(46, 21, 8, '2017-11-03 10:10:54', 1, 2, 0, 0, 91.08, 597.08, 1, 13, '2017-11-03 10:10:54'),
(47, 22, 1, '2017-11-03 10:13:52', 1, 2, 0, 0, 0, 0, 1, 13, '2017-11-03 10:13:52'),
(48, 23, 1, '2017-11-03 10:14:11', 1, 2, 0, 0, 0, 0, 1, 13, '2017-11-03 10:14:11'),
(49, 24, 1, '2017-11-03 10:15:19', 1, 2, 0, 0, 0, 0, 1, 13, '2017-11-03 10:15:19'),
(50, 25, 1, '2017-11-03 10:15:31', 1, 2, 0, 0, 0, 0, 1, 13, '2017-11-03 10:15:31'),
(51, 26, 1, '2017-11-03 10:15:59', 1, 2, 0, 0, 0, 0, 1, 13, '2017-11-03 10:15:59'),
(52, 27, 1, '2017-11-03 10:19:46', 1, 2, 0, 0, 0, 0, 1, 13, '2017-11-03 10:19:46'),
(53, 28, 1, '2017-11-03 10:20:40', 1, 2, 0, 0, 0, 0, 1, 13, '2017-11-03 10:20:40'),
(54, 29, 1, '2017-11-03 10:21:02', 1, 2, 0, 0, 0, 0, 1, 13, '2017-11-03 10:21:02'),
(55, 30, 1, '2017-11-03 10:24:58', 1, 2, 0, 0, 0, 0, 1, 13, '2017-11-03 10:24:58'),
(56, 31, 1, '2017-11-03 10:26:09', 1, 2, 0, 0, 0, 0, 1, 13, '2017-11-03 10:26:09'),
(57, 32, 1, '2017-11-03 10:26:18', 1, 2, 0, 0, 0, 0, 1, 13, '2017-11-03 10:26:18'),
(58, 33, 1, '2017-11-03 10:26:43', 1, 2, 0, 0, 0, 0, 1, 13, '2017-11-03 10:26:43'),
(59, 34, 1, '2017-11-03 10:28:09', 1, 2, 0, 0, 0, 0, 1, 13, '2017-11-03 10:28:09'),
(60, 35, 1, '2017-11-03 10:28:47', 1, 2, 0, 0, 0, 0, 1, 13, '2017-11-03 10:28:47'),
(61, 36, 8, '2017-11-03 10:31:56', 1, 2, 0, 18, 158.76, 1040.76, 1, 13, '2017-11-03 10:31:56');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `monedas`
--

CREATE TABLE `monedas` (
  `IdMoneda` int(11) NOT NULL,
  `Nombre` varchar(10) DEFAULT NULL,
  `Simbolo` varchar(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `monedas`
--

INSERT INTO `monedas` (`IdMoneda`, `Nombre`, `Simbolo`) VALUES
(1, 'Rep.DOM', 'RD$'),
(2, 'USA', 'US$');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `municipios`
--

CREATE TABLE `municipios` (
  `IdMunicipio` int(11) NOT NULL,
  `Nombre` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `municipios`
--

INSERT INTO `municipios` (`IdMunicipio`, `Nombre`) VALUES
(1, 'Imbert'),
(2, 'Luperon');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `nacionalidades`
--

CREATE TABLE `nacionalidades` (
  `IdNacionalidades` int(11) NOT NULL,
  `Nombre` varchar(50) DEFAULT NULL,
  `Pais` varchar(50) DEFAULT NULL,
  `ModificadoPor` int(11) DEFAULT NULL,
  `FechaModificacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `nacionalidades`
--

INSERT INTO `nacionalidades` (`IdNacionalidades`, `Nombre`, `Pais`, `ModificadoPor`, `FechaModificacion`) VALUES
(1, 'Dominicana', 'Republica Dominicana', 21, '2017-10-29 08:39:40'),
(2, 'Americana', 'Estados Unidos', 21, '2017-10-29 08:39:40'),
(3, 'Haitiana', 'Haiti', 21, '2017-10-29 08:39:41'),
(4, 'Venezolana', 'Venezuela', 21, '2017-10-29 08:39:41'),
(5, 'China', 'China', 21, '2017-10-29 08:39:41'),
(6, 'Japones', 'Japon', 21, '2017-10-29 08:39:41');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pacientes`
--

CREATE TABLE `pacientes` (
  `IdPaciente` int(11) NOT NULL,
  `IdPersona` int(11) NOT NULL,
  `SeguroMedico` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `pacientes`
--

INSERT INTO `pacientes` (`IdPaciente`, `IdPersona`, `SeguroMedico`) VALUES
(1, 0, 'ARS'),
(2, 4, 'ARS'),
(3, 5, 'PALIC'),
(4, 6, 'ARS'),
(5, 7, 'ARS'),
(6, 17, 'PALIC'),
(7, 18, 'ARS'),
(8, 20, 'PALIC'),
(9, 21, 'ARS'),
(10, 24, 'ARS');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `personas`
--

CREATE TABLE `personas` (
  `Idpersona` int(11) NOT NULL,
  `Cedula` varchar(50) DEFAULT NULL,
  `Nombres` varchar(40) NOT NULL,
  `Apellido1` varchar(40) NOT NULL,
  `Apellido2` varchar(40) DEFAULT NULL,
  `FechaNacimineto` datetime DEFAULT NULL,
  `IdNacionalidad` int(11) DEFAULT NULL,
  `IdSexo` int(11) DEFAULT NULL,
  `Telefono` varchar(14) DEFAULT NULL,
  `Celular` varchar(14) DEFAULT NULL,
  `Correo` varchar(50) DEFAULT NULL,
  `IdUser` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `personas`
--

INSERT INTO `personas` (`Idpersona`, `Cedula`, `Nombres`, `Apellido1`, `Apellido2`, `FechaNacimineto`, `IdNacionalidad`, `IdSexo`, `Telefono`, `Celular`, `Correo`, `IdUser`, `created_at`, `updated_at`) VALUES
(1, '12312313', 'Carmen', 'Olasio', 'uno', '2017-09-20 00:00:00', 1, 1, '(131) 323-1231', '(131) 232-1331', 'miguel.@gmail.com', 1, '2017-09-21 01:36:25', '2017-09-21 01:36:25'),
(2, '13323232333', 'Miguel anfel', 'Olasio', 'pascual', '2017-09-05 00:00:00', 1, 1, '(535) 325-3252', '(123) 465-3535', 'ssss.@gmail.com', 1, '2017-09-21 21:59:26', '2017-09-21 21:59:26'),
(3, '23123123213', 'Eduardad', 'Cruz', 'olasio', '2017-08-29 00:00:00', 1, 2, '(123) 123-2131', '(312) 321-3123', 'miguel.@gmail.com', 1, '2017-09-21 22:04:25', '2017-09-21 22:04:25'),
(4, '22222', 'Scarlo', 'Brito', 'perez', '2017-09-05 00:00:00', 1, 1, '(333) 333-3333', '(222) 222-2222', 'miguel.@gmail.com', 1, '2017-09-21 22:07:55', '2017-09-21 22:07:55'),
(5, '234656776', 'Nuevo', 'mkm', 'fenandez', '2017-10-12 00:00:00', 1, 1, '(241) 242-1412', '(234) 124-2141', 'imofsf@gmial.com', 1, '2017-09-21 22:19:57', '2017-09-21 22:19:57'),
(6, '2343243', 'oTRO', 'pRUEBA', 'hernandez', '2017-08-29 00:00:00', 1, 1, '(234) 324-3242', '(234) 324-3243', 'DJNADJSA@gmail.com', 1, '2017-09-21 22:21:53', '2017-09-21 22:21:53'),
(7, '3243243256', 'Geremias', 'Hernandez', 'Cruz', '2017-09-05 00:00:00', 2, 1, '(131) 333-3331', '(131) 232-3131', 'miguel.@gmail.com', 1, '2017-09-21 22:48:48', '2017-09-21 22:48:48'),
(8, '3223424124', 'Miguel', 'Hernandez', 'Cruz', '2017-08-29 00:00:00', 1, 1, '(124) 124-1241', '(214) 124-2142', 'miguel@gmail.com', 1, NULL, '2017-09-21 20:48:24'),
(9, '3223424124', 'Miguel', 'Hernandez', 'Cruz', '2017-08-29 00:00:00', 1, 1, '(124) 124-1241', '(214) 124-2142', 'miguel@gmail.com', 1, NULL, '2017-09-21 20:50:01'),
(10, '3223424124', 'Miguel', 'jernandez', 'Cruz', '2017-08-29 00:00:00', 1, 1, '(124) 124-1241', '(214) 124-2142', 'miguel@gmail.com', 1, NULL, '2017-09-21 20:56:38'),
(11, '3223424124', 'Carmen', 'Olasio', 'Cruz', '2017-08-29 00:00:00', 1, 1, '(124) 124-1241', '(214) 124-2142', 'miguel@gmail.com', 1, NULL, '2017-09-21 21:14:51'),
(12, '123-2131231-2', '(`Nombres`)', 'Ramirez', 'Cruz', '2017-09-13 00:00:00', 2, 1, '(123) 123-1232', '(123) 123-1232', 'miguel@gmail.com', 4, '2017-09-21 21:26:44', '2017-11-02 11:06:59'),
(13, '402-2253858-5', 'Scarlo', 'Brito', 'Parra', '2017-11-25 00:00:00', 1, 1, '(664) 654-6464', '(809) 591-5464', 'sbrito@unphu.edu.do', 4, '2017-09-21 21:28:58', '2017-11-01 22:50:01'),
(14, '1234521', 'Henry', 'Fernandez', 'Cruz', '2017-09-06 00:00:00', 1, 1, '(809) 559-7357', '(829) 885-7911', 'Fernandez@gmail.com', 4, '2017-09-21 21:54:36', NULL),
(15, '2313213123', 'Jose', 'Peldomo', 'Mo', '2017-09-05 00:00:00', 1, 1, '(123) 123-2132', '(123) 123-1232', 'Simene@gmail.com', 4, '2017-09-21 22:19:17', NULL),
(16, '12345612', 'Jesus', 'Subero', 'Perez', '2017-08-29 00:00:00', 2, 1, '(123) 123-1231', '(123) 213-1232', 'Subero@gmail.com', 4, '2017-09-21 22:22:00', NULL),
(17, '123123123', 'manuel', 'Olasio', 'Cruz', '2017-09-05 00:00:00', 1, 1, '(123) 123-1232', '(123) 123-1231', '2224f@gmail.com', 4, '2017-09-22 02:32:47', '2017-09-22 02:32:47'),
(18, '03701240677', 'Debiel Corina', 'Pascual', '-', '1995-10-10 00:00:00', 1, 2, '(000) 000-0000', '(829) 580-4201', 'debiel.1095@gmail.com', 10, '2017-09-22 03:26:56', '2017-09-22 03:26:56'),
(19, '200-0075931-1', 'Lenni', 'Salazar', 'Puto', '2017-09-05 00:00:00', 1, 1, '(845) 646-4646', '(859) 449-8656', 'Lenni@gmail.com', 1, '2017-09-28 13:49:33', NULL),
(20, '228-0007589-1', 'Miguel', 'Hernandez', 'Cruz', '2017-10-12 00:00:00', 1, 1, '(898) 999-9988', '(898) 989-8989', 'mn@gmail.com', 1, '2017-10-03 15:46:37', '2017-10-03 15:46:37'),
(21, '402-2253858-5', 'IdPersona', 'Brito', 'Parra', '1994-01-27 00:00:00', 1, 1, '(809) 581-2921', '(809) 710-0727', 'scarbrito27@gmail.com', 1, '2017-10-25 15:49:51', '2017-11-01 23:46:54'),
(22, '229-0007357-1', 'Enmanuel', 'perez', 'alvarado', '2017-10-01 00:00:00', 1, 1, '(213) 990-1011', '(809) 229-9112', 'migueleeee@gmail.com', 1, '2017-10-29 18:42:44', '2017-10-29 18:42:44'),
(23, '402-2253858-5', 'Scarlito', 'Brito', 'Brito', '2017-11-25 00:00:00', 1, 1, '(664) 654-6464', '(809) 591-5464', 'sbrito@unphu.edu.do', 11, '2017-10-31 22:36:08', '2017-11-01 22:59:15'),
(24, '2343243', 'oTRO', 'pRUEBA', NULL, '2017-08-29 00:00:00', 1, 1, '(234) 324-3242', '(234) 324-3243', 'DJNADJSA@gmail.com', 13, '2017-11-02 03:30:16', '2017-11-02 03:30:16');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `procedimientos`
--

CREATE TABLE `procedimientos` (
  `IdProcedimiento` int(11) NOT NULL,
  `Nombre` varchar(50) DEFAULT NULL,
  `ModificadoPor` int(11) NOT NULL,
  `FechaModificacion` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `procedimientos`
--

INSERT INTO `procedimientos` (`IdProcedimiento`, `Nombre`, `ModificadoPor`, `FechaModificacion`) VALUES
(1, 'dasd', 1, '2017-09-20 16:29:08'),
(2, 'Nuevo', 2, '2017-09-20 16:37:59'),
(3, 'Otro', 3, '2017-09-20 17:47:26'),
(4, 'Men', 312, '2017-09-20 17:49:10'),
(5, 'Men', 312, '2017-09-20 17:51:58'),
(6, 'UltimoProcedimiento', 1, '2017-09-20 20:54:09'),
(7, 'rrrrrrrrr', 1, '2017-09-20 21:10:37'),
(8, 'Procologico', 1, '2017-09-20 21:11:50'),
(9, 'Editado', 1, '2017-09-21 12:39:57'),
(10, 'PFFJSA', 1, '2017-10-03 07:15:56'),
(11, 'Cropologico', 1, '2017-09-21 12:48:45'),
(12, 'Analisis de sangre', 4, '2017-09-21 18:26:57'),
(13, 'Analisis de Orina', 10, '2017-09-21 19:11:14'),
(14, 'Hemograma', 1, '2017-10-30 07:42:08');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `IdRol` int(11) NOT NULL,
  `Nombre` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`IdRol`, `Nombre`) VALUES
(1, 'Admin'),
(2, 'Cajero'),
(3, 'Administrador');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sexos`
--

CREATE TABLE `sexos` (
  `IdSexo` int(11) NOT NULL,
  `Codigo` varchar(1) DEFAULT NULL,
  `NOmbre` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sexos`
--

INSERT INTO `sexos` (`IdSexo`, `Codigo`, `NOmbre`) VALUES
(1, 'M', 'Masculino'),
(2, 'F', 'Femenino');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sucursales`
--

CREATE TABLE `sucursales` (
  `IdSucursal` int(11) NOT NULL,
  `Codigo` varchar(10) DEFAULT NULL,
  `Nombre` varchar(50) DEFAULT NULL,
  `Telefono` varchar(14) DEFAULT NULL,
  `Direccion` longtext,
  `IdMunicipio` int(11) DEFAULT NULL,
  `AnoApertura` int(11) DEFAULT NULL,
  `Estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `sucursales`
--

INSERT INTO `sucursales` (`IdSucursal`, `Codigo`, `Nombre`, `Telefono`, `Direccion`, `IdMunicipio`, `AnoApertura`, `Estado`) VALUES
(1, '001', 'Dianostico Santo Domingo', '809-559-3333', 'Calle diajsdjasod', 1, 2017, 1),
(2, 'Lupe017', 'Luperon', '(809) 545-8789', 'c/ Penetración #100', 2, 2017, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipopago`
--

CREATE TABLE `tipopago` (
  `IdTipoPago` int(11) NOT NULL,
  `Nombre` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `tipopago`
--

INSERT INTO `tipopago` (`IdTipoPago`, `Nombre`) VALUES
(1, 'Efectivo'),
(2, 'Tarjeta');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `IdUser` int(11) NOT NULL,
  `IdPersona` int(11) DEFAULT NULL,
  `name` varchar(50) NOT NULL,
  `password` varchar(191) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `IdEstado` int(11) DEFAULT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `IdSucursal` int(11) DEFAULT NULL,
  `IdCargo` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`IdUser`, `IdPersona`, `name`, `password`, `email`, `IdEstado`, `remember_token`, `IdSucursal`, `IdCargo`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Miguel Angel Hernandez', '$2y$10$OkeM9MDkaXcidDClHJCr3OPLJPrB6Ei79BPRCFvSF/D01uWipd7Uu', 'miguel.angelhernandezc1@gmail.com', NULL, 'r7sy0WWWijAPbYmGbTplJzGCKIA0ITJQSnWdhL6N4pToVMGgXkUcZQ2HcIDy', NULL, NULL, '2017-10-30 11:55:21', '2017-09-21 01:35:35'),
(2, 9, 'MHernandez', '$2y$10$3yi25.NA5onXTkzAlG3bJugx.JzrFgFtvbJBq3bYPbfGRumZNYABa', '', 1, '', 1, 1, '2017-10-31 22:30:01', '2017-09-21 20:50:01'),
(3, 10, 'Mjernandez', '123456', '0', 1, '', 1, 1, '2017-09-21 20:56:38', '2017-09-21 20:56:38'),
(4, 11, 'COlasio', '$2y$10$HR3J.0GuLUOiq7Demyr13.5P8mtPmdCdHc6bo5gwtLrELrWnPLG7a', 'COlasio@laboratorioclinicodrgarcia.com', 1, '', 1, 1, '2017-09-21 21:14:51', '2017-09-21 21:14:51'),
(5, 12, '(Ramirez', '$2y$10$r5TzdU9EmDrN4WefrXIY8uKRsDTHOQ9KXD1kYtCq48DOCX9n9CB0.', '(Ramirez@laboratorioclinicodrgarcia.com', 1, '', 1, 1, '2017-11-02 11:06:59', '2017-11-02 11:06:59'),
(7, 14, 'HFernandez', '$2y$10$qC6PPP32WzRdFO.T/LcN4u6EWrvIaw4FDktYdHbPvEkpYM72etgEm', 'HFernandez@laboratorioclinicodrgarcia.com', 1, '', 1, 1, '2017-10-31 22:26:04', '2017-09-21 21:54:36'),
(8, 15, 'JPeldomo', '$2y$10$vkn6vEUu/W3lSxkuQoman.ar8HEl1EO8ayzvQTVFKy0iJo4H.GwbS', 'JPeldomo@laboratorioclinicodrgarcia.com', 1, '', 1, 0, '2017-09-21 22:19:17', '2017-09-21 22:19:17'),
(9, 16, 'JSubero', '$2y$10$CeMCDstKcNlORY59ugxzCOly7AIn.SrQpJWBIxSLnpOmXlEUoB8f.', 'JSubero@laboratorioclinicodrgarcia.com', 1, '', 1, 1, '2017-09-21 22:22:00', '2017-09-21 22:22:00'),
(10, NULL, 'sbrito', '$2y$10$BSNALsC7MxQRYvQ4vbMICeWT1pjzx/6o5ZHj0DNdKZjsBV5hApFlO', 'sbrito@laboratorioclinicodrgarcia.com', NULL, 'tttUQ5zXVspGYdglqAlKokMOkHooM7iCui9kp1fXAd2ZhumEwiJuUrWIse83', NULL, NULL, '2017-11-01 12:27:08', '2017-09-22 03:07:21'),
(11, 19, 'LSalazar', '$2y$10$69E0XDu4xX6Aq/yr6uj7eOGaAglI2lgTNWrIZt.NRoa.XFX4ojsQS', 'LSalazar@laboratorioclinicodrgarcia.com', 1, 'SBjKDMkkusN51dWHdslk5m6I42jaCB5I0wjItlZWnZEP6npDsD4HmYAPZQWm', 1, 2, '2017-10-31 22:48:17', '2017-09-28 13:49:33'),
(12, 23, 'SBrito', '$2y$10$BSNALsC7MxQRYvQ4vbMICeWT1pjzx/6o5ZHj0DNdKZjsBV5hApFlO', 'SBrito@laboratorioclinicodrgarcia.com', 1, '', 1, 1, '2017-11-01 22:59:15', '2017-11-01 22:59:15'),
(13, NULL, 'debiel', '$2y$10$1JYhgW5IPkkDjewpZeWlQu0glHITQ3FFgSogNqo526H37pvaIHjtW', 'debiel@gmail.com', NULL, 'Vx7CtrB0Px0yEZoDdqyRRItYecnHWkseaDyDD9UOWNxK6SNyvQlBQY2HSxTz', NULL, NULL, '2017-11-01 11:45:43', '2017-11-01 02:45:13');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `cargos`
--
ALTER TABLE `cargos`
  ADD PRIMARY KEY (`IdCargo`);

--
-- Indices de la tabla `detallefactura`
--
ALTER TABLE `detallefactura`
  ADD PRIMARY KEY (`IdDetalleFactura`);

--
-- Indices de la tabla `doctores`
--
ALTER TABLE `doctores`
  ADD PRIMARY KEY (`IdDoctor`);

--
-- Indices de la tabla `estadofactura`
--
ALTER TABLE `estadofactura`
  ADD PRIMARY KEY (`IdEstadoFactura`);

--
-- Indices de la tabla `estados`
--
ALTER TABLE `estados`
  ADD PRIMARY KEY (`IdEstado`);

--
-- Indices de la tabla `factura`
--
ALTER TABLE `factura`
  ADD PRIMARY KEY (`IdFactura`);

--
-- Indices de la tabla `historial`
--
ALTER TABLE `historial`
  ADD PRIMARY KEY (`IdHistorial`);

--
-- Indices de la tabla `hitorialfactura`
--
ALTER TABLE `hitorialfactura`
  ADD PRIMARY KEY (`IdDetalleFactura`);

--
-- Indices de la tabla `monedas`
--
ALTER TABLE `monedas`
  ADD PRIMARY KEY (`IdMoneda`);

--
-- Indices de la tabla `municipios`
--
ALTER TABLE `municipios`
  ADD PRIMARY KEY (`IdMunicipio`);

--
-- Indices de la tabla `nacionalidades`
--
ALTER TABLE `nacionalidades`
  ADD PRIMARY KEY (`IdNacionalidades`);

--
-- Indices de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`IdPaciente`);

--
-- Indices de la tabla `personas`
--
ALTER TABLE `personas`
  ADD PRIMARY KEY (`Idpersona`);

--
-- Indices de la tabla `procedimientos`
--
ALTER TABLE `procedimientos`
  ADD PRIMARY KEY (`IdProcedimiento`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`IdRol`);

--
-- Indices de la tabla `sexos`
--
ALTER TABLE `sexos`
  ADD PRIMARY KEY (`IdSexo`);

--
-- Indices de la tabla `sucursales`
--
ALTER TABLE `sucursales`
  ADD PRIMARY KEY (`IdSucursal`);

--
-- Indices de la tabla `tipopago`
--
ALTER TABLE `tipopago`
  ADD PRIMARY KEY (`IdTipoPago`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`IdUser`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `cargos`
--
ALTER TABLE `cargos`
  MODIFY `IdCargo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `detallefactura`
--
ALTER TABLE `detallefactura`
  MODIFY `IdDetalleFactura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT de la tabla `doctores`
--
ALTER TABLE `doctores`
  MODIFY `IdDoctor` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `factura`
--
ALTER TABLE `factura`
  MODIFY `IdFactura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT de la tabla `historial`
--
ALTER TABLE `historial`
  MODIFY `IdHistorial` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT de la tabla `hitorialfactura`
--
ALTER TABLE `hitorialfactura`
  MODIFY `IdDetalleFactura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
--
-- AUTO_INCREMENT de la tabla `monedas`
--
ALTER TABLE `monedas`
  MODIFY `IdMoneda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `municipios`
--
ALTER TABLE `municipios`
  MODIFY `IdMunicipio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `nacionalidades`
--
ALTER TABLE `nacionalidades`
  MODIFY `IdNacionalidades` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT de la tabla `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `IdPaciente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT de la tabla `personas`
--
ALTER TABLE `personas`
  MODIFY `Idpersona` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT de la tabla `procedimientos`
--
ALTER TABLE `procedimientos`
  MODIFY `IdProcedimiento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `IdRol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `sexos`
--
ALTER TABLE `sexos`
  MODIFY `IdSexo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `sucursales`
--
ALTER TABLE `sucursales`
  MODIFY `IdSucursal` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `tipopago`
--
ALTER TABLE `tipopago`
  MODIFY `IdTipoPago` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `IdUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
