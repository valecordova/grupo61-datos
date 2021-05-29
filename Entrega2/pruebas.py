import psycopg2
from csv import reader
try:
    conn = psycopg2.connect(
        database='grupo61e2',
        user='grupo61',
        host='localhost',
        port=5432,
        password='pizza123'
    )
    # Obtenemos un cursor
    cursor1 = conn.cursor()

    # Definimos los nuevos datos que vamos a ingresar
    with open('direcciones.csv', 'r') as read_obj:

        csv_reader = reader(read_obj)
        lista_direcciones = list(map(tuple, csv_reader))
        lista_direcciones = lista_direcciones[1:]

    with open('usuarios.csv', 'r') as read_obj:

        csv_reader = reader(read_obj)
        lista_usuarios = list(map(tuple, csv_reader))
        lista_usuarios = lista_usuarios[1:]

    with open('trabajadores.csv', 'r') as read_obj:

        csv_reader = reader(read_obj)
        lista_trabajadores = list(map(tuple, csv_reader))
        lista_trabajadores = lista_trabajadores[1:]

    with open('plano_coberturaV2.csv', 'r') as read_obj:

        csv_reader = reader(read_obj)
        lista_tiendas = list(map(tuple, csv_reader))
        lista_tiendas = lista_tiendas[1:]

    with open('comprasV2.csv', 'r') as read_obj:

        csv_reader = reader(read_obj)
        lista_compras = list(map(tuple, csv_reader))
        lista_compras = lista_compras[1:]

    with open('productosV2.csv', 'r') as read_obj:

        csv_reader = reader(read_obj)
        lista_productos = list(map(tuple, csv_reader))
        lista_productos = lista_productos[1:]

    # Definimos el cuerpo de la consulta
    query_direcciones = "INSERT INTO Direcciones VALUES ({id}, '{nombre}', '{comuna}');"
    for id, nombre, comuna in lista_direcciones:
        cursor1.execute(query_direcciones.format(id=id, nombre=nombre, comuna=comuna))

    query_tiendas = "INSERT INTO Tiendas VALUES ({id}, '{nombre}', {direccion}, {jefe}, '{comuna}');"
    for id, nombre, direccion, jefe, comuna in lista_tiendas:
        cursor1.execute(query_tiendas.format(
            id=id, nombre=nombre, direccion=direccion, jefe=jefe, comuna=comuna))

    query_usuarios = "INSERT INTO Usuarios VALUES ({id}, '{nombre}', '{sexo}', '{rut}', {edad}, {direccion});"
    for id, nombre, rut, edad, sexo, direccion in lista_usuarios:
        cursor1.execute(query_usuarios.format(id=id, nombre=nombre[0], sexo=sexo, rut=rut, edad=edad, direccion=direccion))

    query_trabajadores = "INSERT INTO Trabajadores VALUES ({id}, '{nombre}', '{rut}', {edad}, '{sexo}', {tienda});"
    for id, nombre, rut, edad, sexo, tienda in lista_trabajadores:
        cursor1.execute(query_trabajadores.format(
            id=id, nombre=nombre, rut=rut, edad=edad, sexo=str(sexo), tienda=tienda))

    query_compras = "INSERT INTO Compras VALUES ({id}, {comprador}, {direccion}, {producto}, {tienda});"
    for id, comprador, direccion, producto, tienda in lista_tiendas:
        cursor1.execute(query_compras.format(
            id=id, comprador=comprador, direccion=direccion, producto=producto, tienda=tienda))

    query_ventas = "INSERT INTO Ventas VALUES ({producto}, {tienda});"
    for i in lista_productos:
        cursor1.execute(query_ventas.format(producto=i[0], tienda=i[11]))

    query_productos = "INSERT INTO Productos VALUES ({id}, '{nombre}', {precio}, '{descripcion}');"
    query_pnocomestible = "INSERT INTO PNoComestibles VALUES ({id}, {largo}, {alto}, {ancho}, {peso});"
    query_comestible = "INSERT INTO PComestibles VALUES ({id}, {caducidad});"
    query_congelados = "INSERT INTO PCongelados VALUES ({id}, {peso});"
    query_frescos = "INSERT INTO PFrescos VALUES ({id}, {sinrefri});"
    query_conserva = "INSERT INTO PConserva VALUES ({id}, {conserva});"

    for id, nombre, precio, descripcion, largo, alto, ancho, peso, caducidad, sinrefri, conserva, tienda in lista_productos:
        cursor1.execute(query_productos.format(i=id, nombre=nombre, precio=precio, descripcion=descripcion))
        if descripcion == 'pantalla de luz' or descripcion == 'producto tecnologico' or descripcion == 'ropa':
            pass
            cursor1.execute(
                query_pnocomestible.format(i=id, largo=largo, alto=alto, ancho=ancho, peso=peso))
        else:
            cursor1.execute(
                query_comestible.format(i=id, caducidad=caducidad))
            if descripcion == 'pescado congelado' or descripcion == 'hamburguesa' or \
                    descripcion == 'carne congelada' or descripcion == 'verduras congeladas':
                cursor1.execute(query_congelados.format(i=id, peso=peso))
            elif descripcion == 'carne' or descripcion == 'frutas' or descripcion == 'pan' or descripcion == 'verduras':
                cursor1.execute(query_frescos.format(i=id, sinrefri=sinrefri))
            elif descripcion == 'frurta en conserva' or descripcion == 'verdura en conserva':
                cursor1.execute(query_conserva.format(i=id, conserva=conserva))


    # Guardamos los cambios
    conn.commit()
    # Cerramos el cursor
    cursor1.close()

    # MUY IMPORTANTE
    conn.close()

except Exception as e:
    print('Hubo un problema :c')
    print(e)
