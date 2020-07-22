package com.cristian.dayclass;

import java.util.List;
import org.hibernate.*; 
import org.hibernate.boot.registry.*; 
import org.hibernate.cfg.Configuration; 
import org.hibernate.service.*; 

public class HibernateUtil { 
    
    private static SessionFactory sessionFactory; 
    
    public HibernateUtil () {
    } 
    
    private static SessionFactory buildSessionFactory () {
        
        Configuration configuration = new Configuration();
        configuration.configure("hibernate.cfg.xml");
        configuration.addAnnotatedClass(Administrativo.class);
        configuration.addAnnotatedClass(Alumno.class);
        configuration.addAnnotatedClass(AlumnoCursoActual.class);
        configuration.addAnnotatedClass(AlumnoCursoEstado.class);
        configuration.addAnnotatedClass(Asistencia.class);
        configuration.addAnnotatedClass(AsistenciaDia.class);
        configuration.addAnnotatedClass(Cargo.class);
        configuration.addAnnotatedClass(CargoProfesor.class);
        configuration.addAnnotatedClass(CodigoAsistencia.class);
        configuration.addAnnotatedClass(ContraseniaRestablecida.class);
        configuration.addAnnotatedClass(Curso.class);
        configuration.addAnnotatedClass(CursoDia.class);
        configuration.addAnnotatedClass(CursoEstadoAlumno.class);
        configuration.addAnnotatedClass(Division.class);
        configuration.addAnnotatedClass(EstadoCargoProfesor.class);
        configuration.addAnnotatedClass(HorarioCurso.class);
        configuration.addAnnotatedClass(Institucion.class);
        configuration.addAnnotatedClass(Justificativo.class);
        configuration.addAnnotatedClass(JustificativoAsistenciaDia.class);
        configuration.addAnnotatedClass(Materia.class);
        configuration.addAnnotatedClass(Modalidad.class);
        configuration.addAnnotatedClass(NotificacionProfe.class);
        configuration.addAnnotatedClass(ParamMinimoAsistencia.class);
        configuration.addAnnotatedClass(Permiso.class);
        configuration.addAnnotatedClass(Profesor.class);
        configuration.addAnnotatedClass(ProgramaMateria.class);
        configuration.addAnnotatedClass(TemaDia.class);
        configuration.addAnnotatedClass(TemasMateria.class);
        configuration.addAnnotatedClass(TiempoLimiteCodigo.class);
        configuration.addAnnotatedClass(TipoAsistencia.class);
        configuration.addAnnotatedClass(VigenciaSesion.class);
        
        ServiceRegistry serviceRegistry = new StandardServiceRegistryBuilder().applySettings(configuration.getProperties()).build();
        sessionFactory = configuration.buildSessionFactory(serviceRegistry);
        return sessionFactory;
    } 
    
    public static SessionFactory getSessionFactory () {
    
        if (sessionFactory == null || sessionFactory.isClosed()) {
            sessionFactory = buildSessionFactory();
        }
        return sessionFactory;
    }
    
    public static Session getSession () {
        if (sessionFactory == null || sessionFactory.isClosed()) {
            sessionFactory = getSessionFactory();
        }
        try {
            return sessionFactory.getCurrentSession();
        }
        catch (NullPointerException e) {
            return sessionFactory.openSession();
        }
    }
    
    public static List<Object> buscar(String consulta) {
        getSession().beginTransaction();
        Query q = getSession().createQuery(consulta);
        List<Object> list = q.list();
        getSession().getTransaction();
        getSession().close();
        
        return list;
        
    }
    
    public static void guardar(Object obj) {
        getSession().beginTransaction();
        getSession().save(obj);
        getSession().getTransaction().commit();
        getSession().close();
    }
    
    public static void eliminar(Object obj) {
        getSession().beginTransaction();
        getSession().delete(obj);
        getSession().getTransaction().commit();
        getSession().close();
    }
    
    public static void actualizar(Object obj) {
        getSession().beginTransaction();
        getSession().update(obj);
        getSession().getTransaction().commit();
        getSession().close();
    }
}