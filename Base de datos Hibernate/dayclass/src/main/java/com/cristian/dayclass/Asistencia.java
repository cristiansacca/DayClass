
package com.cristian.dayclass;
import java.io.Serializable;
import java.util.Date;
import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;
import javax.persistence.ManyToOne;
import javax.persistence.OneToMany;
import javax.persistence.Table;
import javax.persistence.Temporal;

@Entity
@Table(name="Asistencia", schema="dayclass")
public class Asistencia implements Serializable{
    private static final long serialVersionUID = 1L;    
    @Id
    @GeneratedValue(strategy=GenerationType.IDENTITY)
    private int id;
    private int nroFichaAsistencia;
    @ManyToOne
    private Alumno alumno;
    @ManyToOne
    private Curso curso;

    public Asistencia() {
    }

    public static long getSerialVersionUID() {
        return serialVersionUID;
    }

    public int getId() {
        return id;
    }

    public int getNroFichaAsistencia() {
        return nroFichaAsistencia;
    }

    public Alumno getAlumno() {
        return alumno;
    }

    public Curso getCurso() {
        return curso;
    }

    public void setId(int id) {
        this.id = id;
    }

    public void setNroFichaAsistencia(int nroFichaAsistencia) {
        this.nroFichaAsistencia = nroFichaAsistencia;
    }

    public void setAlumno(Alumno alumno) {
        this.alumno = alumno;
    }

    public void setCurso(Curso curso) {
        this.curso = curso;
    }

}
