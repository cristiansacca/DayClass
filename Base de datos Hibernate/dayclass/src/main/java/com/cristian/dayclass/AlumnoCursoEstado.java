package com.cristian.dayclass;

import java.io.Serializable;
import java.util.Date;
import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;
import javax.persistence.ManyToOne;
import javax.persistence.Table;
import javax.persistence.Temporal;

/**
 *
 * @author Cristian
 */
@Entity
@Table(name="AlumnoCursoEstado", schema="dayclass")
public class AlumnoCursoEstado implements Serializable {
    
    private static final long serialVersionUID = 1L;    
    @Id
    @GeneratedValue(strategy=GenerationType.SEQUENCE)
    private int id;
    @Temporal(javax.persistence.TemporalType.DATE)
    private Date fechaFinEstado;
    @Temporal(javax.persistence.TemporalType.DATE)
    private Date fechaInicioEstado;
    
    @ManyToOne
    private AlumnoCursoActual alumnoCursoActual;
    @ManyToOne
    private CursoEstadoAlumno cursoEstadoAlumno;

    public AlumnoCursoEstado() {
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public Date getFechaFinEstado() {
        return fechaFinEstado;
    }

    public void setFechaFinEstado(Date fechaFinEstado) {
        this.fechaFinEstado = fechaFinEstado;
    }

    public Date getFechaInicioEstado() {
        return fechaInicioEstado;
    }

    public void setFechaInicioEstado(Date fechaInicioEstado) {
        this.fechaInicioEstado = fechaInicioEstado;
    }

    public AlumnoCursoActual getAlumnoCursoActual() {
        return alumnoCursoActual;
    }

    public void setAlumnoCursoActual(AlumnoCursoActual alumnoCursoActual) {
        this.alumnoCursoActual = alumnoCursoActual;
    }

    public CursoEstadoAlumno getCursoEstadoAlumno() {
        return cursoEstadoAlumno;
    }

    public void setCursoEstadoAlumno(CursoEstadoAlumno cursoEstadoAlumno) {
        this.cursoEstadoAlumno = cursoEstadoAlumno;
    }
    
}
