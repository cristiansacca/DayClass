package com.cristian.dayclass;

import java.io.Serializable;
import java.util.Date;
import javax.persistence.Entity;
import javax.persistence.GeneratedValue;
import javax.persistence.GenerationType;
import javax.persistence.Id;
import javax.persistence.ManyToOne;
import javax.persistence.Table;

/**
 *
 * @author Cristian
 */
@Entity
@Table(name="ParamMinimoAsistencia", schema="dayclass")
public class ParamMinimoAsistencia implements Serializable {
    
    private static final long serialVersionUID = 1L;    
    @Id
    @GeneratedValue(strategy=GenerationType.SEQUENCE)
    private int id;
    private Date fechaAltaMinimoAsistencia;
    private Date fechaBajaMinimoAsistencia;
    private int porcentajeAsistencia;
    
    @ManyToOne
    private CursoEstadoAlumno cursoEstadoAlumno;

    public ParamMinimoAsistencia() {
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public Date getFechaAltaMinimoAsistencia() {
        return fechaAltaMinimoAsistencia;
    }

    public void setFechaAltaMinimoAsistencia(Date fechaAltaMinimoAsistencia) {
        this.fechaAltaMinimoAsistencia = fechaAltaMinimoAsistencia;
    }

    public Date getFechaBajaMinimoAsistencia() {
        return fechaBajaMinimoAsistencia;
    }

    public void setFechaBajaMinimoAsistencia(Date fechaBajaMinimoAsistencia) {
        this.fechaBajaMinimoAsistencia = fechaBajaMinimoAsistencia;
    }

    public int getPorcentajeAsistencia() {
        return porcentajeAsistencia;
    }

    public void setPorcentajeAsistencia(int porcentajeAsistencia) {
        this.porcentajeAsistencia = porcentajeAsistencia;
    }

    public CursoEstadoAlumno getCursoEstadoAlumno() {
        return cursoEstadoAlumno;
    }

    public void setCursoEstadoAlumno(CursoEstadoAlumno cursoEstadoAlumno) {
        this.cursoEstadoAlumno = cursoEstadoAlumno;
    }
    
}
