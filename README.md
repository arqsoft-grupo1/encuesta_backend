Encuesta backend
========================
# Test de performance

| Servicio   | cpu_quota  | cpu_set| Mem_*  |
| ---------- | ---------- | --     | --     |
| web        | libre      | libre  | libre  |   
| mongo      | libre      | libre  | libre  |

#### Test 1
Usuario : 700
RampUp  : 120

Resumen resultado

| Samples   | Average    | Min   | Max    | Std dev  | Error % |
| ----------| ---------- | --    | --     | --       | --      |
| 2100      |  15712     | 0     |  91465 | 14397.42 | 0.091   |  

#### Test 2
Usuario : 600
RampUp  : 120

Resumen resultado

| Samples   | Average    | Min   | Max    | Std dev  | Error % |
| ----------| ---------- | --    | --     | --       | --      |
| 1800      |  11236     | 0     |  60006 | 8623.35  | 0.015   |  

#### Test 3
Usuario : 500
RampUp  : 120

Resumen resultado

| Samples   | Average    | Min   | Max    | Std dev  | Error % |
| ----------| ---------- | --    | --     | --         | --        |
| 1500      |  8035      | 95     |  17333| 4360.95  |    0    |  

#### Test limitación docker (Memoria)

| Servicio   | cpu_quota  | cpu_set| mem_limit  |
| ---------- | ---------- | --     | --         |
| web        | libre      | libre  | 1024m      |   
| mongo      | libre      | libre  | libre      |

#### Test 1
Usuario : 500
RampUp  : 120

Resumen resultado

| Samples   | Average    | Min   | Max    | Std dev  | Error % |
| ----------| ---------- | --    | --     | --         | --        |
| 1500      |  15173     | 0     |  60012 | 10603.46 |  2.13%  |
------------------------------------------------------------------

| Servicio   | cpu_quota  | cpu_set| mem_limit  |
| ---------- | ---------- | --     | --         |
| web        | libre      | libre  | 2048m      |   
| mongo      | libre      | libre  | libre      |

#### Test 2
Usuario : 500
RampUp  : 120

Resumen resultado

| Samples   | Average    | Min   | Max    | Std dev  | Error % |
| ----------| ---------- | --    | --     | --         | --        |
| 1500      |  15173     | 0     |  60012 | 10603.46 |  2.13%  |

#### Test limitación docker

| Servicio   | cpu_quota  | cpu_set| Mem_*  |
| ---------- | ---------- | --     | --     |
| web        | 200000     | 0,1    | libre  |   
| mongo      | 50000      | 2      | libre  |

Dos procesadores al 100%

#### Test 1
Usuario : 500
RampUp  : 120

Resumen resultado

| Samples   | Average    | Min   | Max    | Std dev  | Error % |
| ----------| ---------- | --    | --     | --         | --        |
| 1500      |  27232     | 0     |  91587 | 19878.81 | 18.53%  |  

#### Test 2
Usuario : 400
RampUp  : 120

Resumen resultado

| Samples   | Average    | Min   | Max    | Std dev  | Error % |
| ----------| ---------- | --    | --     | --         | --        |
| 1200      |   24154    | 0     |  77224 | 16161.58 | 5.58%   |

#### Test 3
Usuario : 350
RampUp  : 120

Resumen resultado

| Samples   | Average    | Min   | Max    | Std dev  | Error % |
| ----------| ---------- | --    | --     | --         | --        |
| 1050      |   20673    | 0     |  66877 | 12611.54 | 1.64%   |  


#### Test 4
Usuario : 300
RampUp  : 120

Resumen resultado

| Samples   | Average    | Min   | Max    | Std dev  | Error % |
| ----------| ---------- | --    | --     | --         | --        |
| 900       |   15503    | 127   |  30530 | 8636.55  | 0%      |


***************************************
Dos CPU al 50%

| Servicio   | cpu_quota  | cpu_set| Mem_*  |
| ---------- | ---------- | --     | --     |
| web        | 100000     | 0,1    | libre  |   
| mongo      | 50000      | 2      | libre  |

#### Test 1
Usuario : 500
RampUp  : 120

Resumen resultado

| Samples   | Average    | Min   | Max    | Std dev  | Error % |
| ----------| ---------- | --    | --     | --         | --        |
| 1500      |  36462     | 0    |  91622 | 26624.10  | 55.87%  |  


#### Test 2
Usuario : 200
RampUp  : 120

Resumen resultado

| Samples   | Average    | Min   | Max    | Std dev  | Error % |
| ----------| ---------- | --    | --     | --         | --        |
| 600       |  27712     | 122    |  56425| 15879.23 | 0%  |  


------------

![Texto alternativo](/doc/monitoreo/breakdowntable.png)

![Texto alternativo](/doc/monitoreo/throughput.png)

![Texto alternativo](/doc/monitoreo/top5webtransactions.png)

![Texto alternativo](/doc/monitoreo/transactions.png)

![Texto alternativo](/doc/monitoreo/webtransactionstime.png)

----------------------------------------------------

## Conclusiones
Luego de estos resultados provistos anteriormente, para bajar tiempos de respuesta sacamos de la respuesta del encuesta_update el json que retornaba la encuesta respondida, esta respuesta no se utilizaba, por lo tanto simplemente retornamos que se actualizo correctamente, logrando un descenso considerable en el tiempo de respuesta.  
Luego de esto limitamos el uso a 2 CPU y 2048MB de memoria para el container utilizado para PHP y 1 CPU con 1024MB de memoria para el contariner que utiliza la base de datos (mongo). Los resultados fueron los siguientes sin errores.

#### Test final
* Usuario : 100  
* RampUp  : 60  
* Tiempo  : 15'

100 usuarios concurrentes por un tiempo de 15 minutos

Resumen resultado

| Samples   | Average    | Min   | Max    | Std dev  | Error % |
| ----------| ---------- | --    | --     | --       | --      |
| 3719      |  23776     | 162   |  33058 | 5391.32  |    0    |  

Por lo tanto para un rendimiento optimo con 0% de error la configuración correcta seria la siguiente

* PHP:  
      2 Cores al 100%  
      2 GB Ram de memoria  
* Mongo:  
      1 Core al 50%  
      1 GB Ram de memoria  

Agregamos resultados finales basados en monitoreo de la aplicación con la configuración antes mencionada

![Texto alternativo](/doc/monitoreo/webtransactionsLimitado.png)

![Texto alternativo](/doc/monitoreo/throughputLimitado.png)

![Texto alternativo](/doc/monitoreo/top5webtransactionsLimitado.png)

![Texto alternativo](/doc/monitoreo/transactionsLimitado.png)
