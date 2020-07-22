/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
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
@Table(name="AlumnoCursoActual", schema="dayclass")
public class AlumnoCursoActual implements Serializable {
    
    private static final long serialVersionUID = 1L;    
    @Id
    @GeneratedValue(strategy=GenerationType.SEQUENCE)
    private int id;
    @Temporal(javax.persistence.TemporalType.DATE)
    private Date fechaDesdeAlumCurAc;
    @Temporal(javax.persistence.TemporalType.DATE)
    private Date fechaHastaAlumCurAc;
    
    @ManyToOne
    private Alumno alumno;
    @ManyToOne
    private Curso curso;

    public AlumnoCursoActual() {
    }

    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    public Date getFechaDesdeAlumCurAc() {
        return fechaDesdeAlumCurAc;
    }

    public void setFechaDesdeAlumCurAc(Date fechaDesdeAlumCurAc) {
        this.fechaDesdeAlumCurAc = fechaDesdeAlumCurAc;
    }

    public Date getFechaHastaAlumCurAc() {
        return fechaHastaAlumCurAc;
    }

    public void setFechaHastaAlumCurAc(Date fechaHastaAlumCurAc) {
        this.fechaHastaAlumCurAc = fechaHastaAlumCurAc;
    }

    public Alumno getAlumno() {
        return alumno;
    }

    public void setAlumno(Alumno alumno) {
        this.alumno = alumno;
    }

    public Curso getCurso() {
        return curso;
    }

    public void setCurso(Curso curso) {
        this.curso = curso;
    }
    
}
